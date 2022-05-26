<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
/** @noinspection SenselessPropertyInspection */
/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace CarloNicora\Minimalism\Services\OAuth\Data\Apps\DataObjects;

use CarloNicora\Minimalism\Interfaces\Security\Interfaces\ApplicationInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\DbFieldType;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\Apps\Databases\AppsTable;

#[DbTable(tableClass: AppsTable::class)]
class App implements SqlDataObjectInterface, ApplicationInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField(field: AppsTable::appId)]
    private int $id;

    /** @var int */
    #[DbField]
    private int $userId;

    /** @var string */
    #[DbField]
    private string $name;

    /** @var string */
    #[DbField]
    private string $url;

    /** @var bool */
    #[DbField]
    private bool $isActive = false;

    /** @var bool */
    #[DbField]
    private bool $isTrusted = false;

    /** @var string */
    #[DbField]
    private string $clientId;

    /** @var int */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private int $createdAt;

    /** @var string|null */
    #[DbField]
    private ?string $clientSecret = null;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     */
    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    /**
     * @return bool
     */
    public function isTrusted(): bool
    {
        return $this->isTrusted;
    }

    /**
     * @param bool $isTrusted
     */
    public function setIsTrusted(bool $isTrusted): void
    {
        $this->isTrusted = $isTrusted;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt(int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    /**
     * @param string|null $clientSecret
     */
    public function setClientSecret(
        string $clientSecret = null
    ): void
    {
        $this->clientSecret = $clientSecret;
    }

}