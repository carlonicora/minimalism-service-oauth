<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Apps\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Interfaces\Sql\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Interfaces\Sql\Factories\SqlJoinFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\Apps\Databases\AppsTable;
use CarloNicora\Minimalism\Services\OAuth\Data\Apps\DataObjects\App;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\Databases\TokensTable;
use Exception;

class AppIO extends AbstractSqlIO
{
    /**
     * @param string $token
     * @return App
     * @throws Exception
     */
    public function readByToken(
        string $token,
    ): App
    {
        $factory = SqlQueryFactory::create(AppsTable::class)
            ->selectAll()
            ->addJoin(
                SqlJoinFactory::create(
                    primaryKey: AppsTable::appId,
                    foreignKey: TokensTable::appId,
                ),
            )
            ->addParameter(TokensTable::token, $token);

        return $this->data->read(
            queryFactory: $factory,
            responseType: App::class,
        );
    }

    /**
     * @param string $clientId
     * @return App
     * @throws Exception
     */
    public function readByClientId(
        string $clientId,
    ): App
    {
        $factory = SqlQueryFactory::create(AppsTable::class)
            ->selectAll()
            ->addParameter(AppsTable::clientId, $clientId);

        return $this->data->read(
            queryFactory: $factory,
            responseType: App::class,
        );
    }
}