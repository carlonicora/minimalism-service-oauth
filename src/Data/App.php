<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Interfaces\Security\Interfaces\ApplicationInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlDataObject;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AppsTable;

class App extends AbstractSqlDataObject implements ApplicationInterface
{
    /** @var int  */
    private int $appId;

    /** @var int  */
    private int $userId;

    /** @var string  */
    private string $name;

    /** @var string  */
    private string $url;

    /** @var bool  */
    private bool $isActive;

    /** @var bool  */
    private bool $isTrusted;

    /** @var string  */
    private string $clientId;

    /** @var string|null  */
    private ?string $clientSecret=null;

    /** @var int  */
    private int $creationTime;

    /**
     * @param array $data
     * @return void
     */
    public function import(
        array $data,
    ): void
    {
        $this->appId = $data['appId'];
        $this->userId = $data['userId'];
        $this->name = $data['name'];
        $this->url = $data['url'];
        $this->isActive = $data['isActive'];
        $this->isTrusted = $data['isTrusted'];
        $this->clientId = $data['clientId'];
        $this->clientSecret = $data['clientSecret'];
        $this->creationTime = strtotime($data['creationTime']);
    }

    /**
     * @return SqlTableInterface
     */
    public function getTable(
    ): SqlTableInterface
    {
        return AppsTable::tableName;
    }

    /**
     * @return array
     */
    public function export(
    ): array
    {
        $response = parent::export();

        $response['appId'] = $this->appId ?? null;
        $response['userId'] = $this->userId;
        $response['name'] = $this->name;
        $response['url'] = $this->url;
        $response['isActive'] = $this->isActive;
        $response['isTrusted'] = $this->isTrusted;
        $response['clientId'] = $this->clientId;
        $response['clientSecret'] = $this->clientSecret;
        $response['creationTime'] = date('Y-m-d H:i:s', $this->creationTime ?? time());

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
     * @return string
     */
    public function getUrl(
    ): string
    {
        return $this->url;
    }

    /**
     * @return bool
     */
    public function isActive(
    ): bool
    {
        return $this->isActive;
    }

    /**
     * @return bool
     */
    public function isTrusted(
    ): bool
    {
        return $this->isTrusted;
    }

    /**
     * @return int
     */
    public function getId(
    ): int
    {
        return $this->appId;
    }

    /**
     * @return string
     */
    public function getName(
    ): string
    {
        return $this->name;
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
     * @param string $name
     */
    public function setName(
        string $name,
    ): void
    {
        $this->name = $name;
    }

    /**
     * @param string $url
     */
    public function setUrl(
        string $url,
    ): void
    {
        $this->url = $url;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(
        string $clientId,
    ): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @param string|null $clientSecret
     */
    public function setClientSecret(
        ?string $clientSecret,
    ): void
    {
        $this->clientSecret = $clientSecret;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(
        bool $isActive,
    ): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @param bool $isTrusted
     */
    public function setIsTrusted(
        bool $isTrusted,
    ): void
    {
        $this->isTrusted = $isTrusted;
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
}