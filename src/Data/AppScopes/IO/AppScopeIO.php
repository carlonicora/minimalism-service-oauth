<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\Databases\AppScopesTable;
use CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\DataObjects\AppScope;
use Exception;

class AppScopeIO extends AbstractSqlIO
{
    /**
     * @param int $appId
     * @return AppScope[]
     * @throws Exception
     */
    public function readByAppId(
        int $appId,
    ): array
    {
        return $this->data->read(
            queryFactory: SqlQueryFactory::create(AppScopesTable::class)
                ->addParameter(field: AppScopesTable::appId, value: $appId),
            responseType: AppScope::class,
            requireObjectsList: true,
        );
    }
}