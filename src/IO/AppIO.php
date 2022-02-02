<?php
namespace CarloNicora\Minimalism\Services\OAuth\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlFactory;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlJoinFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\App;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AppsTable;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\TokensTable;
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
        $factory = SqlFactory::create(AppsTable::class)
            ->selectAll()
            ->addJoin(
                new SqlJoinFactory(
                    primaryKey: AppsTable::appId,
                    foreignKey: TokensTable::appId,
                ),
            )
            ->addParameter(TokensTable::token, $token);

        return $this->data->read(
            factory: $factory,
            sqlObjectInterfaceClass: App::class,
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
        $factory = SqlFactory::create(AppsTable::class)
            ->selectAll()
            ->addParameter(AppsTable::clientId, $clientId);

        return $this->data->read(
            factory: $factory,
            sqlObjectInterfaceClass: App::class,
        );
    }
}