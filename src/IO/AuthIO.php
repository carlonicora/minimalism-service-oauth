<?php
namespace CarloNicora\Minimalism\Services\OAuth\IO;

use CarloNicora\Minimalism\Services\OAuth\Abstracts\AbstractIO;
use CarloNicora\Minimalism\Services\OAuth\Data\Auth;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AuthsTable;
use Exception;

class AuthIO extends AbstractIO
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
        /** @see AuthsTable::readByCode() */
        $recordset = $this->data->read(
            tableInterfaceClassName: AuthsTable::class,
            functionName: 'readByCode',
            parameters: [$code],
        );

        return $this->returnSingleObject(
            recordset: $recordset,
            objectType: Auth::class,
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
        return $this->returnSingleObject(
            recordset: $this->data->insert(
                tableInterfaceClassName: AuthsTable::class,
                records: [$auth->export()],
            ),
            objectType: Auth::class,
        );
    }
}