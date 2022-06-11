<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Auths\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\DbFieldType;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\Auths\Databases\AuthsTable;
use Exception;

#[DbTable(tableClass: AuthsTable::class)]
class Auth implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField]
    private int $authId;

    /** @var int */
    #[DbField]
    private int $appId;

    /** @var int */
    #[DbField]
    private int $userId;

    /** @var string */
    #[DbField]
    private string $code;

    /** @var int */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private int $expiration;

    /** @var int */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private int $createdAt;

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
     * @param int $seconds
     */
    public function setExpirationSeconds(
        int $seconds,
    ): void
    {
        $this->expiration = time() + $seconds;
    }

    /** @return int */
    public function getAuthId(): int{return $this->authId;}

    /** @param int $authId */
    public function setAuthId(int $authId): void{$this->authId = $authId;}

    /** @return int */
    public function getAppId(): int{return $this->appId;}

    /** @param int $appId */
    public function setAppId(int $appId): void{$this->appId = $appId;}

    /** @return int */
    public function getUserId(): int{return $this->userId;}

    /** @param int $userId */
    public function setUserId(int $userId): void{$this->userId = $userId;}

    /** @return string */
    public function getCode(): string{return $this->code;}

    /** @param string $code */
    public function setCode(string $code): void{$this->code = $code;}

    /** @return int */
    public function getExpiration(): int{return $this->expiration;}

    /** @param int $expiration */
    public function setExpiration(int $expiration): void{$this->expiration = $expiration;}

    /** @return int */
    public function getCreatedAt(): int{return $this->createdAt;}

    /** @param int $createdAt */
    public function setCreatedAt(int $createdAt): void{$this->createdAt = $createdAt;}
}