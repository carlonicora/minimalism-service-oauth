<?php
/** @noinspection SenselessPropertyInspection */

/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace CarloNicora\Minimalism\Services\OAuth\Data\Auths\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\DbFieldType;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\Auths\Databases\AuthsTable;
use Exception;

#[DbTable(tableClass: AuthsTable::class)]
class Auth implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::AutoIncrement)]
    private int $authId;

    /** @var int */
    #[SqlField(fieldType: FieldType::Integer)]
    private int $appId;

    /** @var int */
    #[SqlField(fieldType: FieldType::Integer)]
    private int $userId;

    /** @var int */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private int $expiration;

    /** @var string */
    #[DbField]
    private string $code;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->code = bin2hex(random_bytes(32));
    }

    /**
     * @return bool
     */
    public function isExpired(): bool
    {
        return $this->expiration < time();
    }

    /**
     * @return int
     */
    public function getAppId(): int
    {
        return $this->appId;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return int
     */
    public function getExpiration(): int
    {
        return $this->expiration;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
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
     * @param int $authId
     */
    public function setAuthId(
        int $authId
    ): void
    {
        $this->authId = $authId;
    }

    /**
     * @param string $code
     * @return void
     */
    public function setCode(
        string $code
    ): void
    {
        $this->code = $code;
    }

}