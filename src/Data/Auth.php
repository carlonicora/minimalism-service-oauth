<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Factories\ObjectFactory;
use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlDataObject;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AuthsTable;
use Exception;

class Auth extends AbstractSqlDataObject
{
    /** @var int  */
    private int $authId;

    /** @var int  */
    private int $appId;

    /** @var int  */
    private int $userId;

    /** @var int  */
    private int $expiration;

    /** @var string  */
    private string $code;

    /**
     * @param ObjectFactory $objectFactory
     * @param array|null $data
     * @throws Exception
     */
    public function __construct(
        ObjectFactory $objectFactory,
        ?array $data = null,
    )
    {
        parent::__construct($objectFactory, $data);

        if ($data === null){
            $this->code = bin2hex(random_bytes(32));
        }
    }

    /**
     * @return SqlTableInterface
     */
    public function getTable(
    ): SqlTableInterface
    {
        return AuthsTable::tableName;
    }

    /**
     * @param array $data
     * @return void
     */
    public function import(
        array $data,
    ): void
    {
        $this->authId = $data['authId'];
        $this->appId = $data['appId'];
        $this->userId = $data['userId'];
        $this->expiration = strtotime($data['expiration']);
        $this->code = $data['code'];
    }

    /**
     * @return array
     */
    public function export(
    ): array
    {
        $response = parent::export();

        $response['authId'] = $this->authId ?? null;
        $response['appId'] = $this->appId;
        $response['userId'] = $this->userId;
        $response['expiration'] = date('Y-m-d H:i:s', $this->expiration ?? time());
        $response['code'] = $this->code;

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
}