<?php

namespace CarloNicora\Minimalism\Services\OAuth\Data;

use CarloNicora\Minimalism\Services\DataMapper\Abstracts\AbstractDataObject;

class App extends AbstractDataObject
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

    /** @var string  */
    private string $clientSecret;

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
    public function getAppId(
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
}