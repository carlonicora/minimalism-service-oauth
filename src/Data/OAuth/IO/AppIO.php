<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlJoinFactory;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases\AppsTable;
use CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases\TokensTable;
use CarloNicora\Minimalism\Services\OAuth\Data\OAuth\DataObjects\App;
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
                new SqlJoinFactory(
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