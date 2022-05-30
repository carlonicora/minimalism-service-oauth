<?php

namespace CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\Databases\UserScopesTable;

#[DbTable(tableClass: UserScopesTable::class)]
class UserScope
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField]
    private int $userScopeId;

    /** @var int */
    #[DbField]
    private int $userId;

    /** @var int */
    #[DbField]
    private int $appId;

    /** @var int */
    #[DbField]
    private int $scopeId;

    /** @return int */
    public function getUserScopeId(): int{return $this->userScopeId;}

    /** @param int $userScopeId */
    public function setUserScopeId(int $userScopeId): void{$this->userScopeId = $userScopeId;}

    /** @return int */
    public function getUserId(): int{return $this->userId;}

    /** @param int $userId */
    public function setUserId(int $userId): void{$this->userId = $userId;}

    /** @return int */
    public function getAppId(): int{return $this->appId;}

    /** @param int $appId */
    public function setAppId(int $appId): void{$this->appId = $appId;}

    /** @return int */
    public function getScopeId(): int{return $this->scopeId;}

    /** @param int $scopeId */
    public function setScopeId(int $scopeId): void{$this->scopeId = $scopeId;}
}