<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Scopes\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Interfaces\Sql\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\Scopes\Databases\ScopesTable;
use CarloNicora\Minimalism\Services\OAuth\Data\Scopes\DataObjects\Scope;
use Exception;

class ScopeIO extends AbstractSqlIO
{
    /**
     * @param int $scopeId
     * @return Scope
     * @throws Exception
     */
    public function readById(
        int $scopeId,
    ): Scope
    {
        return $this->data->read(
            queryFactory: SqlQueryFactory::create(ScopesTable::class)
                ->addParameter(field: ScopesTable::scopeId, value: $scopeId),
            responseType: Scope::class,
        );
    }
}