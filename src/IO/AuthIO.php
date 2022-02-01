<?php
namespace CarloNicora\Minimalism\Services\OAuth\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\Auth;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AuthsTable;
use Exception;

class AuthIO extends AbstractSqlIO
{
    /**
     * @param string $code
     * @return Auth
     * @throws Exception
     */
    public function readByCode(
        string $code,
    ): Auth
    {
        $factory = SqlFactory::create()
            ->selectAll(AuthsTable::tableName)
            ->addParameter(AuthsTable::code, $code);

        return $this->data->read(
            factory: $factory,
            singleReturnedObjectInterfaceName: Auth::class,
        );
    }

    /**
     * @param Auth $auth
     * @return Auth
     * @throws Exception
     */
    public function insert(
        Auth $auth,
    ): Auth
    {
        return $this->data->create(
            factory: $auth,
            singleReturnedObjectInterfaceName: Auth::class,
        );
    }
}