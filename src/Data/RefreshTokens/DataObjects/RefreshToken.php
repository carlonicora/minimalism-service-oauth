<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\Databases\RefreshTokensTable;
use Exception;

#[DbTable(tableClass: RefreshTokensTable::class)]
class RefreshToken implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField]
    private int $refreshTokenId;

    /** @var int|null */
    #[DbField]
    private ?int $parentId;

    /** @var int */
    #[DbField]
    private int $appId;

    /** @var int */
    #[DbField]
    private int $userId;

    /** @var string */
    #[DbField]
    private string $token;

    /** @var bool */
    #[DbField]
    private bool $isValid = false;

    /**
     * @throws Exception
     */
    public function __construct(
    )
    {
        $this->token = bin2hex(random_bytes(32));
    }

    /*** @return int */
    public function getRefreshTokenId(): int{return $this->refreshTokenId;}

    /** @param int $refreshTokenId */
    public function setRefreshTokenId(int $refreshTokenId): void{$this->refreshTokenId = $refreshTokenId;}

    /**
     * @return int|null
     */
    public function getParentId(): ?int{return $this->parentId;}

    /** @param int|null $parentId */
    public function setParentId(?int $parentId): void{$this->parentId = $parentId;}

    /** @return int */
    public function getAppId(): int{return $this->appId;}

    /** @param int $appId */
    public function setAppId(int $appId): void{$this->appId = $appId;}

    /** @return int */
    public function getUserId(): int{return $this->userId;}

    /** @param int $userId */
    public function setUserId(int $userId): void{$this->userId = $userId;}

    /** @return string */
    public function getToken(): string{return $this->token;}

    /** @param string $token */
    public function setToken(string $token): void{$this->token = $token;}

    /** @param bool $isValid */
    public function setIsValid(bool $isValid): void{$this->isValid = $isValid;}

    /** @return bool */
    public function isValid(): bool{return $this->isValid;}
}