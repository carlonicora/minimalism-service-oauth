<?php

namespace CarloNicora\Minimalism\Services\OAuth;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Enums\HttpCode;
use CarloNicora\Minimalism\Exceptions\MinimalismException;
use CarloNicora\Minimalism\Factories\ServiceFactory;
use CarloNicora\Minimalism\Interfaces\Security\Interfaces\ApplicationInterface;
use CarloNicora\Minimalism\Interfaces\Security\Interfaces\SecurityInterface;
use CarloNicora\Minimalism\Services\OAuth\Data\Apps\IO\AppIO;
use CarloNicora\Minimalism\Services\OAuth\Data\Auths\DataObjects\Auth;
use CarloNicora\Minimalism\Services\OAuth\Data\Auths\IO\AuthIO;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\DataObjects\Token;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\IO\TokenIO;
use Exception;

class OAuth extends AbstractService implements SecurityInterface
{
    /** @var array|null */
    private ?array $headers = null;

    /** @var Token|null */
    private ?Token $token = null;

    /**
     * @param string $MINIMALISM_SERVICE_OAUTH_PRIVATE_KEY
     * @param bool $MINIMALISM_SERVICE_OAUTH_ALLOW_VISITORS_TOKEN
     */
    public function __construct(
        private readonly string $MINIMALISM_SERVICE_OAUTH_PRIVATE_KEY,
        private readonly bool $MINIMALISM_SERVICE_OAUTH_ALLOW_VISITORS_TOKEN = false,
    )
    {
    }

    /**
     * @return string
     */
    public function getPrivateKey(): string {
        return $this->MINIMALISM_SERVICE_OAUTH_PRIVATE_KEY;
    }

    /**
     * @return string|null
     */
    public static function getBaseInterface(): ?string
    {
        return SecurityInterface::class;
    }

    /**
     * @return void
     */
    public function destroy(): void
    {
        $this->headers = null;
        $this->token   = null;
    }

    /**
     * @return bool
     */
    public function allowVisitorsToken(): bool
    {
        return $this->MINIMALISM_SERVICE_OAUTH_ALLOW_VISITORS_TOKEN;
    }

    /**
     * @return ApplicationInterface
     * @throws Exception
     */
    public function getApp(): ApplicationInterface
    {
        return $this->objectFactory->create(AppIO::class)->readByToken($this->token->getToken());
    }

    /**
     * @return int|null
     */
    public function getUserId(): ?int
    {
        return $this->token?->getUserId();
    }

    /**
     * @return bool|null
     */
    public function isUser(): ?bool
    {
        return $this->token?->isUser();
    }

    /**
     * @param ServiceFactory $services
     * @return void
     * @throws MinimalismException
     */
    public function postIntialise(
        ServiceFactory $services,
    ): void
    {
        if ($this->token === null) {
            if ($this->headers === null) {
                $this->headers = getallheaders();
            }

            $bearer = $this->headers['Authorization'] ?? null;
            if ($bearer === null) {
                return;
            }

            [, $token] = explode(' ', $bearer);

            if (empty($token)) {
                return;
            }

            $this->loadToken($token);
        }
    }

    /**
     * @param string $token
     * @return void
     * @throws MinimalismException
     */
    public function loadToken(
        string $token,
    ): void
    {
        try {
            $this->token = $this->objectFactory->create(TokenIO::class)->readByToken($token);
        } catch (Exception) {
            throw new MinimalismException(status: HttpCode::Unauthorized, message: 'Authorization token not found');
        }
    }

    /**
     * @param string $clientId
     * @param int|null $userId
     * @param string|null $state
     * @return string
     * @throws Exception
     */
    public function generateRedirection(
        string  $clientId,
        ?int    $userId = null,
        ?string $state = null,
    ): string
    {
        if ($state === null) {
            $state = '';
        }

        $app = $this->objectFactory->create(AppIO::class)->readByClientId($clientId);

        $response = $app->getUrl();

        if ($userId !== null) {
            $auth = new Auth();
            $auth->setAppId($app->getId());
            $auth->setUserId($userId);
            $auth->setExpirationSeconds(30);
            $auth = $this->objectFactory->create(AuthIO::class)->insert($auth);

            $response .= str_contains($response, '?') ? '&' : '?'
                . 'code=' . $auth->getCode()
                . '&state=' . $state;
        } else {
            $response .= str_contains($response, '?') ? '&' : '?'
                . 'state=' . $state;
        }

        return $response;
    }

    /**
     * @param int $userId
     * @return void
     * @throws Exception
     */
    public function deleteAuthDataForUser(
        int $userId
    ): void
    {
        $tokenIO = $this->objectFactory->create(className: TokenIO::class);
        $tokenIO->deleteByUserId($userId);
    }

}

// @codeCoverageIgnoreStart
if (! function_exists('getallheaders')) {
    // @codeCoverageIgnoreEnd
    function getallheaders(): array
    {
        $headers = [];
        foreach ($_SERVER ?? [] as $name => $value) {
            if (str_starts_with($name, 'HTTP_')) {
                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
            }
        }
        return $headers;
    }
    // @codeCoverageIgnoreStart
}
// @codeCoverageIgnoreEnd