<?php

namespace CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\Databases\AppScopesTable;

#[DbTable(tableClass: AppScopesTable::class)]
class AppScope implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField]
    private int $appId;

    /** @var int */
    #[DbField]
    private int $scopeId;

    /**
     * @return int
     */
    public function getAppId(): int
    {
        return $this->appId;
    }

    /**
     * @param int $appId
     */
    public function setAppId(int $appId): void
    {
        $this->appId = $appId;
    }

    /**
     * @return int
     */
    public function getScopeId(): int
    {
        return $this->scopeId;
    }

    /**
     * @param int $scopeId
     */
    public function setScopeId(int $scopeId): void
    {
        $this->scopeId = $scopeId;
    }

}