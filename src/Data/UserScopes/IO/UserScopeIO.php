<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
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
}