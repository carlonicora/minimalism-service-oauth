<?php
/** @noinspection PhpUnusedPrivateFieldInspection */
/** @noinspection SenselessPropertyInspection */
/** @noinspection PhpPropertyOnlyWrittenInspection */

namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\DataObjects;

use CarloNicora\Minimalism\Interfaces\Security\Interfaces\ApplicationInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\DbFieldType;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases\AppsTable;

#[DbTable(tableClass: AppsTable::class)]
class App  implements SqlDataObjectInterface, ApplicationInterface
{
    use SqlDataObjectTrait;

    /** @var int  */
    #[DbField]
    private int $appId;

    /** @var int  */
    #[DbField]
    private int $userId;

    /** @var string  */
    #[DbField]
    private string $name;

    /** @var string  */
    #[DbField]
    private string $url;

    /** @var bool  */
    #[DbField]
    private bool $isActive;

    /** @var bool  */
    #[DbField]
    private bool $isTrusted;

    /** @var string  */
    #[DbField]
    private string $clientId;

    /** @var string|null  */
    #[DbField]
    private ?string $clientSecret=null;

    /** @var int|null  */
    #[DbField(fieldType: DbFieldType::IntDateTime)]
    private ?int $creationTime=null;

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