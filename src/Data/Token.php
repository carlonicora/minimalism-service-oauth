<?php

namespace CarloNicora\Minimalism\Services\OAuth\Data;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Exceptions\MinimalismException;
use CarloNicora\Minimalism\Factories\ObjectFactory;
use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlDataObject;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlTableFactory;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AppsTable;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\TokensTable;
use Exception;

class Token extends AbstractSqlDataObject
{
    /** @var int  */
    private int $tokenId;

    /** @var int  */
    private int $appId;

    /** @var int  */
    private int $userId;

    /** @var bool  */
    private bool $isUser;

    /** @var string  */
    private string $token;

    /**
     * @param ObjectFactory|null $objectFactory
     * @param array|null $data
     * @throws Exception
     */
    public function __construct(
        ?ObjectFactory $objectFactory=null,
        ?array $data = null,
    )
    {
        parent::__construct($objectFactory, $data);

        if ($data === null){
            $this->token = bin2hex(random_bytes(32));
        }
    }

    /**
     * @return string
     */
    public function getTableClass(
    ): string
    {
        return TokensTable::class;
    }

    /**
     * @return SqlTableInterface
     * @throws MinimalismException
     */
    public function getTable(
    ): SqlTableInterface
    {
        return SqlTableFactory::create(AppsTable::class);
    }

    /**
     * @param array $data
     * @return void
     */
    public function import(
        array $data,
    ): void
    {
        $this->tokenId = $data['tokenId'];
        $this->appId = $data['appId'];
        $this->userId = $data['userId'];
        $this->isUser = $data['isUser'];
        $this->token = $data['token'];
    }

    /**
     * @return array
     */
    public function export(
    ): array
    {
        $response = parent::export();

        $response['tokenId'] = $this->tokenId ?? null;
        $response['appId'] = $this->appId;
        $response['userId'] = $this->userId;
        $response['isUser'] = $this->isUser;
        $response['token'] = $this->token;

        return $response;
    }

    /**
     * @return ResourceObject
     */
    public function generateResource(
    ): ResourceObject
    {
        return new ResourceObject();
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