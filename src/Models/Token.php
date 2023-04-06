<?php

namespace CarloNicora\Minimalism\Services\OAuth\Models;

use CarloNicora\Minimalism\Abstracts\AbstractModel;
use CarloNicora\Minimalism\Enums\HttpCode;
use CarloNicora\Minimalism\Services\OAuth\Data\Apps\IO\AppIO;
use CarloNicora\Minimalism\Services\OAuth\Data\Auths\IO\AuthIO;
use CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\DataObjects\RefreshToken;
use CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\IO\RefreshTokenIO;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\IO\TokenIO;
use CarloNicora\Minimalism\Services\OAuth\Enums\GrantType;
use CarloNicora\Minimalism\Services\OAuth\JsonApi\NonJsonApiDocument;
use CarloNicora\Minimalism\Services\OAuth\OAuth;
use Exception;
use RuntimeException;

class Token extends AbstractModel
{
    /**
     * @param OAuth $OAuth
     * @param array $payload
     * @return HttpCode
     * @throws Exception
     */
    public function post(
        OAuth $OAuth,
        array $payload,
    ): HttpCode
    {
        $grantType = GrantType::tryFrom(strtolower($payload['grant_type']));

        if ($grantType !== GrantType::AuthorizationCode && $grantType !== GrantType::ClientCredentials && $grantType !== GrantType::RefreshToken) {
            throw new RuntimeException('grant_type not supported', HttpCode::BadRequest->value);
        }

        if ($grantType === GrantType::ClientCredentials && ! $OAuth->allowVisitorsToken()) {
            throw new RuntimeException('grant_type not supported', HttpCode::BadRequest->value);
        }

        header("Access-Control-Allow-Origin: *");
        $response = [
            'access_token' => '',
            'refresh_token' => '',
            'token_type' => 'bearer',
            'expires' => '',
        ];

        $token = new \CarloNicora\Minimalism\Services\OAuth\Data\Tokens\DataObjects\Token();

        if ($grantType === GrantType::AuthorizationCode) {
            $auth = $this->objectFactory->create(AuthIO::class)->readByCode($payload['code']);

            if ($auth->isExpired()) {
                throw new RuntimeException('The authorization code is incorrect or expired', HttpCode::PreconditionFailed->value);
            }

            $newRefreshToken = new RefreshToken();
            $newRefreshToken->setIsValid(true);
            $newRefreshToken->setAppId($auth->getAppId());
            $newRefreshToken->setUserId($auth->getUserId());
            /** @noinspection UnusedFunctionResultInspection */
            $this->objectFactory->create(RefreshTokenIO::class)->insert($newRefreshToken);
            $response['refresh_token'] = $newRefreshToken->getToken();

            $token->setAppId($auth->getAppId());
            $token->setUserId($auth->getUserId());
            $token->setIsUser(true);
        } else if ($grantType === GrantType::RefreshToken) {
            $refreshToken = $this->objectFactory->create(RefreshTokenIO::class)->readByToken($payload['refresh_token']);
            
            if (!$refreshToken->isValid()) {
                throw new RuntimeException('The authorization code is incorrect or expired', HttpCode::PreconditionFailed->value);
            }

            $this->objectFactory->create(RefreshTokenIO::class)->invalidateDescendent($refreshToken->getRefreshTokenId());

            $newRefreshToken = new RefreshToken();
            $newRefreshToken->setParentId($refreshToken->getRefreshTokenId());
            $newRefreshToken->setIsValid(true);
            $newRefreshToken->setAppId($refreshToken->getAppId());
            $newRefreshToken->setUserId($refreshToken->getUserId());
            /** @noinspection UnusedFunctionResultInspection */
            $this->objectFactory->create(RefreshTokenIO::class)->insert($newRefreshToken);
            $response['refresh_token'] = $newRefreshToken->getToken();

            $token->setAppId($refreshToken->getAppId());
            $token->setUserId($refreshToken->getUserId());
            $token->setIsUser(true);
        } else {
            $app = $this->objectFactory->create(AppIO::class)->readByClientId($payload['client_id']);

            $token->setAppId($app->getId());
            $token->setUserId((int)(microtime(true) * 1000));
            $token->setIsUser(false);
        }

        $token->setExpiration(time() + $OAuth->getTokenDuration());
        $token->generateToken($OAuth->getPrivateKey());

        $token = $this->objectFactory->create(TokenIO::class)->insert($token);

        $response['access_token'] = $token->getToken();
        $response['expires'] = $token->getExpiration();

        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");

        $this->document = new NonJsonApiDocument();
        $this->document->meta->add('output', $response);

        return HttpCode::Created;
    }
}