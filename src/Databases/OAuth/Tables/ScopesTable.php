<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Services\MySQL\Abstracts\AbstractMySqlTable;
use CarloNicora\Minimalism\Services\MySQL\Interfaces\FieldInterface;
use Exception;

class ScopesTable extends AbstractMySqlTable
{
    /** @var string */
    protected static string $tableName = 'scopes';

    /** @var array  */
    protected static array $fields = [
        'scopeId'   => FieldInterface::INTEGER
                    +  FieldInterface::PRIMARY_KEY
                    +  FieldInterface::AUTO_INCREMENT,
        'name'      => FieldInterface::STRING
    ];

    /**
     * @param int $appId
     * @return array
     * @throws Exception
     */
    public function readByAppId(
        int $appId,
    ): array
    {
        $this->sql = 'SELECT *'
            . ' FROM ' . self::getTableName()
            . ' JOIN ' . AppScopesTable::getTableName()
            . ' ON ' . self::getTableName() . '.scopId=' . AppScopesTable::getTableName() . '.scopeId'
            . ' WHERE ' . AppScopesTable::getTableName() . '.appId=?;';
        $this->parameters = ['i', $appId];

        return $this->functions->runRead();
    }
}