<?php
namespace CarloNicora\Minimalism\Services\OAuth\Models;

use CarloNicora\Minimalism\Abstracts\AbstractModel;
use CarloNicora\Minimalism\Enums\HttpCode;
use CarloNicora\Minimalism\Services\OAuth\Enums\GrantType;
use CarloNicora\Minimalism\Services\OAuth\IO\AppIO;
use CarloNicora\Minimalism\Services\OAuth\IO\AuthIO;
use CarloNicora\Minimalism\Services\OAuth\IO\TokenIO;
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

        if ($grantType !== GrantType::AuthorizationCode && $grantType !== GrantType::ClientCredentials){
            throw new RuntimeException('grant_type not supported', HttpCode::BadRequest->value);
        }

        if ($grantType === GrantType::ClientCredentials && !$OAuth->allowVisitorsToken()){
            throw new RuntimeException('grant_type not supported', HttpCode::BadRequest->value);
        }

        header("Access-Control-Allow-Origin: *");
        $response = [
            'access_token' => '',
            'token_type' => 'bearer'
        ];

        $token = new \CarloNicora\Minimalism\Services\OAuth\Data\Token($this->objectFactory);

        if ($grantType === GrantType::AuthorizationCode) {
            $auth = $this->objectFactory->create(AuthIO::class)->readByCode($payload['code']);

            if ($auth->isExpired()) {
                throw new RuntimeException('The authorization code is incorrect or expired', HttpCode::PreconditionFailed->value);
            }

            $token->setAppId($auth->getAppId());
            $token->setUserId($auth->getUserId());
            $token->setIsUser(true);
        } else {
            $app = $this->objectFactory->create(AppIO::class)->readByClientId($payload['client_id']);

            $token->setAppId($app->getAppId());
            $token->setUserId((int)(microtime(true)*1000));
            $token->setIsUser(false);
        }

        $token = $this->objectFactory->create(TokenIO::class)->insert($token);

        $response['access_token'] = $token->getToken();

        header('Content-Type: application/json');
        header("Access-Control-Allow-Origin: *");

        $this->document = new NonJsonApiDocument();
        $this->document->meta->add('output', $response);

        return HttpCode::Created;
    }
}