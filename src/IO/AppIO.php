<?php
namespace CarloNicora\Minimalism\Services\OAuth\IO;

use CarloNicora\Minimalism\Services\DataMapper\Abstracts\AbstractLoader;
use CarloNicora\Minimalism\Services\OAuth\Data\App;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\AppsTable;
use CarloNicora\Minimalism\Services\OAuth\Factories\CacheFactory;
use Exception;

class AppIO extends AbstractLoader
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
        /** @see AppsTable::readByToken() */
        $recordset = $this->data->read(
            tableInterfaceClassName: AppsTable::class,
            functionName: 'readByToken',
            parameters: [$token],
            cacheBuilder: CacheFactory::app($token),
        );

        return $this->returnSingleObject(
            recordset: $recordset,
            objectType: App::class,
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
        /** @see AppsTable::readByClientId() */
        $recordset = $this->data->read(
            tableInterfaceClassName: AppsTable::class,
            functionName: 'readByClientId',
            parameters: [$clientId],
            cacheBuilder: CacheFactory::appClientId($clientId),
        );

        return $this->returnSingleObject(
            recordset: $recordset,
            objectType: App::class,
        );
    }
}