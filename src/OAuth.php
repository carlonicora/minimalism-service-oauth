<?php
namespace CarloNicora\Minimalism\Services\OAuth;

use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Enums\HttpCode;
use CarloNicora\Minimalism\Exceptions\MinimalismException;
use CarloNicora\Minimalism\Factories\ServiceFactory;
use CarloNicora\Minimalism\Interfaces\Security\Interfaces\ApplicationInterface;
use CarloNicora\Minimalism\Interfaces\Security\Interfaces\SecurityInterface;
use CarloNicora\Minimalism\Services\OAuth\Data\Auth;
use CarloNicora\Minimalism\Services\OAuth\Data\Token;
use CarloNicora\Minimalism\Services\OAuth\IO\AppIO;
use CarloNicora\Minimalism\Services\OAuth\IO\AuthIO;
use CarloNicora\Minimalism\Services\OAuth\IO\TokenIO;
use Exception;

class OAuth extends AbstractService implements SecurityInterface
{
    /** @var array|null */
    private ?array $headers=null;

    /** @var Token|null  */
    private ?Token $token=null;

    /**
     * @param bool $MINIMALISM_SERVICE_OAUTH_ALLOW_VISITORS_TOKEN
     */
    public function __construct(
        private bool $MINIMALISM_SERVICE_OAUTH_ALLOW_VISITORS_TOKEN=false,
    )
    {
    }

    /**
     * @return string|null
     */
    public static function getBaseInterface(
    ): ?string
    {
        return SecurityInterface::class;
    }

    /**
     * @return void
     */
    public function destroy(
    ): void
    {
        $this->headers = null;
        $this->token = null;
    }

    /**
     * @return bool
     */
    public function allowVisitorsToken(
    ): bool
    {
        return $this->MINIMALISM_SERVICE_OAUTH_ALLOW_VISITORS_TOKEN;
    }

    /**
     * @return ApplicationInterface
     * @throws Exception
     */
    public function getApp(
    ): ApplicationInterface
    {
        return $this->objectFactory->create(AppIO::class)->readByToken($this->token->getToken());
    }

    /**
     * @return int|null
     */
    public function getUserId(
    ): ?int
    {
        return $this->token?->getUserId();
    }

    /**
     * @return bool|null
     */
    public function isUser(
    ): ?bool
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
        if ($this->headers === null) {
            $this->headers = getallheaders();
        }

        $bearer = $this->headers['Authorization'] ?? null;
        if ($bearer === null){
            return;
        }

        [,$token] = explode(' ', $bearer);

        if (empty($token)) {
            return;
        }

        $this->loadToken($token);
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
     * @param int $userId
     * @param string $state
     * @return string
     * @throws Exception
     */
    public function generateRedirection(
        string $clientId,
        int $userId,
        string $state='',
    ): string
    {
        $app = $this->objectFactory->create(AppIO::class)->readByClientId($clientId);

        $auth = new Auth($this->objectFactory);
        $auth->setAppId($app->getId());
        $auth->setUserId($userId);
        $auth->setExpirationSeconds(30);
        $auth = $this->objectFactory->create(AuthIO::class)->insert($auth);

        $response = $app->getUrl();

        $response .= str_contains($response, '?') ? '&' : '?'
            . 'code=' . $auth->getCode()
            . '&state=' . $state;

        return $response;
    }
}

// @codeCoverageIgnoreStart
if (!function_exists('getallheaders'))
{
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