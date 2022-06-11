<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Scopes\DataObjects;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbField;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\DbTable;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlDataObjectInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Traits\SqlDataObjectTrait;
use CarloNicora\Minimalism\Services\OAuth\Data\Scopes\Databases\ScopesTable;

#[DbTable(tableClass: ScopesTable::class)]
class Scope implements SqlDataObjectInterface
{
    use SqlDataObjectTrait;

    /** @var int */
    #[DbField]
    private int $scopeId;

    /** @var string */
    #[DbField]
    private string $name;

    /** @return int */
    public function getScopeId(): int{return $this->scopeId;}

    /** @param int $scopeId */
    public function setScopeId(int $scopeId): void{$this->scopeId = $scopeId;}

    /** @return string */
    public function getName(): string{return $this->name;}

    /** @param string $name */
    public function setName(string $name): void{$this->name = $name;}
}