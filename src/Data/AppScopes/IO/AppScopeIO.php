<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\DataObjects\AppScope;
use Exception;

class AppScopeIO extends AbstractSqlIO
{
    /**
     * @param AppScope[] $appScopes
     * @return AppScope[]
     * @throws Exception
     */
    public function insertScopes(
        array $appScopes,
    ): array
    {
        return $this->data->create(
            queryFactory: $appScopes,
            responseType: AppScope::class,
            requireObjectsList: true,
        );
    }
}