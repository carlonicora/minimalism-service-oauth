<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Interfaces\Sql\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\Databases\UserScopesTable;
use CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\DataObjects\UserScope;
use Exception;

class UserScopeIO extends AbstractSqlIO
{
    /**
     * @param UserScope[] $userScopes
     * @return UserScope[]
     * @throws Exception
     */
    public function insertScopes(
        array $userScopes,
    ): array
    {
        return $this->data->create(
            queryFactory: $userScopes,
            responseType: UserScope::class,
            requireObjectsList: true,
        );
    }

    /**
     * @param int $userId
     * @param int $appId
     * @return UserScope[]
     * @throws Exception
     */
    public function readyByUserIdAppId(
        int $userId,
        int $appId,
    ): array
    {
        return $this->data->read(
            queryFactory: SqlQueryFactory::create(UserScopesTable::class)
                ->addParameter(field: UserScopesTable::userId, value: $userId)
                ->addParameter(field: UserScopesTable::appId, value: $appId),
            responseType: UserScope::class,
            requireObjectsList: true,
        );
    }

    /**
     * @param int $userId
     * @param int $appId
     * @return void
     * @throws Exception
     */
    public function deleteByUserIdAppId(
        int $userId,
        int $appId,
    ): void
    {
        $this->data->delete(
            queryFactory: SqlQueryFactory::create(UserScopesTable::class)->delete()
                ->addParameter(field: UserScopesTable::userId, value: $userId)
                ->addParameter(field: UserScopesTable::appId, value: $appId),
        );
    }
}