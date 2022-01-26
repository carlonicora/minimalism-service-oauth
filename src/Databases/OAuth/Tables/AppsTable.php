<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Services\MySQL\Abstracts\AbstractMySqlTable;
use CarloNicora\Minimalism\Services\MySQL\Interfaces\FieldInterface;
use Exception;

class AppsTable extends AbstractMySqlTable
{
    /** @var string */
    protected static string $tableName = 'apps';

    /** @var array  */
    protected static array $fields = [
        'appId'         => FieldInterface::INTEGER
                        +  FieldInterface::PRIMARY_KEY
                        +  FieldInterface::AUTO_INCREMENT,
        'userId'        => FieldInterface::INTEGER,
        'name'          => FieldInterface::STRING,
        'url'           => FieldInterface::STRING,
        'isActive'      => FieldInterface::INTEGER,
        'isTrusted'     => FieldInterface::INTEGER,
        'clientId'      => FieldInterface::STRING,
        'clientSecret'  => FieldInterface::STRING,
        'creationTime'  => FieldInterface::STRING
                        +  FieldInterface::TIME_CREATE
    ];

    /**
     * @param string $client_id
     * @return array
     * @throws Exception
     */
    public function readByClientId(
        string $client_id,
    ): array
    {
        $this->sql = 'SELECT *'
            . ' FROM ' . self::getTableName()
            . ' WHERE clientId=?;';
        $this->parameters = ['s', $client_id];

        return $this->functions->runRead();
    }

    /**
     * @param string $token
     * @return array
     * @throws Exception
     */
    public function readByToken(
        string $token,
    ): array
    {
        $this->sql = 'SELECT ' . self::getTableName() . '.*'
            . ' FROM ' . self::getTableName()
            . ' JOIN ' . TokensTable::getTableName()
            . ' ON ' . self::getTableName() . '.appId=' . TokensTable::getTableName() . '.appId'
            . ' WHERE ' . TokensTable::getTableName() . '.token=?;';
        $this->parameters = ['s', $token];

        return $this->functions->runRead();
    }
}