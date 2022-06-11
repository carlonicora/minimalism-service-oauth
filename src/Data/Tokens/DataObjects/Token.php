<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Tokens\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\DbFieldType;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\Databases\TokensTable;
use Exception;

#[DbTable(tableClass: TokensTable::class)]
class Token implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField]
    private int $tokenId;

    /** @var int */
    #[DbField]
    private int $appId;

    /** @var int */
    #[DbField]
    private int $userId;

    /** @var bool */
    #[DbField]
    private bool $isUser = false;

    /** @var string */
    #[DbField]
    private string $token;

    /** @var int|null */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private ?int $expiration=null;

    /** @var int */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private int $createdAt;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->token = bin2hex(random_bytes(32));
    }

    /*** @return int */
    public function getTokenId(): int{return $this->tokenId;}

    /** @param int $tokenId */
    public function setTokenId(int $tokenId): void{$this->tokenId = $tokenId;}

    /** @return int */
    public function getAppId(): int{return $this->appId;}

    /** @param int $appId */
    public function setAppId(int $appId): void{$this->appId = $appId;}

    /** @return int */
    public function getUserId(): int{return $this->userId;}

    /** @param int $userId */
    public function setUserId(int $userId): void{$this->userId = $userId;}

    /** @param bool $isUser */
    public function setIsUser(bool $isUser): void{$this->isUser = $isUser;}

    /** @return bool */
    public function isUser(): bool{return $this->isUser;}

    /** @return string */
    public function getToken(): string{return $this->token;}

    /** @param string $token */
    public function setToken(string $token): void{$this->token = $token;}

    /** @return int|null */
    public function getExpiration(): ?int{return $this->expiration;}

    /** @param int|null $expiration */
    public function setExpiration(?int $expiration): void{$this->expiration = $expiration;}

    /** @return int */
    public function getCreatedAt(): int{return $this->createdAt;}

    /** @param int $createdAt */
    public function setCreatedAt(int $createdAt): void{$this->createdAt = $createdAt;}
}