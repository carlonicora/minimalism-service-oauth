<?php
/** @noinspection SenselessPropertyInspection */
/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\DbFieldType;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases\AuthsTable;
use Exception;

#[DbTable(tableClass: AuthsTable::class)]
class Auth implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int  */
    #[DbField]
    private int $authId;

    /** @var int  */
    #[DbField]
    private int $appId;

    /** @var int  */
    #[DbField]
    private int $userId;

    /** @var int  */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private int $expiration;

    /** @var string  */
    #[DbField]
    private string $code;

    /**
     * @throws Exception
     */
    public function __construct(
    )
    {
        $this->code = bin2hex(random_bytes(32));
    }

    /**
     * @return bool
     */
    public function isExpired(
    ): bool
    {
        return $this->expiration < time();
    }

    /**
     * @return int
     */
    public function getAppId(
    ): int
    {
        return $this->appId;
    }

    /**
     * @return int
     */
    public function getUserId(
    ): int
    {
        return $this->userId;
    }

    /**
     * @param int $appId
     */
    public function setAppId(
        int $appId,
    ): void
    {
        $this->appId = $appId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(
        int $userId,
    ): void
    {
        $this->userId = $userId;
    }

    /**
     * @param int $seconds
     */
    public function setExpirationSeconds(
        int $seconds,
    ): void
    {
        $this->expiration = time() + $seconds;
    }

    /**
     * @return string
     */
    public function getCode(
    ): string
    {
        return $this->code;
    }

    /**
     * @param int $authId
     */
    public function setAuthId(
        int $authId
    ): void
    {
        $this->authId = $authId;
    }
}