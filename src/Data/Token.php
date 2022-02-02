<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
/** @noinspection SenselessPropertyInspection */
/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace CarloNicora\Minimalism\Services\OAuth\Data;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Services\MySQL\Abstracts\AbstractSqlDataObject;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\TokensTable;
use Exception;

#[DbTable(tableClass: TokensTable::class)]
class Token extends AbstractSqlDataObject
{
    /** @var int  */
    #[DbField]
    private int $tokenId;

    /** @var int  */
    #[DbField]
    private int $appId;

    /** @var int  */
    #[DbField]
    private int $userId;

    /** @var bool  */
    #[DbField]
    private bool $isUser;

    /** @var string  */
    #[DbField]
    private string $token;

    /**
     * @throws Exception
     */
    public function __construct(
    )
    {
        $this->token = bin2hex(random_bytes(32));
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
     * @param bool $isUser
     */
    public function setIsUser(
        bool $isUser,
    ): void
    {
        $this->isUser = $isUser;
    }

    /**
     * @param string $token
     */
    public function setToken(
        string $token,
    ): void
    {
        $this->token = $token;
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
     * @return int
     */
    public function getUserId(
    ): int
    {
        return $this->userId;
    }

    /**
     * @return bool
     */
    public function isUser(
    ): bool
    {
        return $this->isUser;
    }

    /**
     * @return string
     */
    public function getToken(
    ): string
    {
        return $this->token;
    }
}