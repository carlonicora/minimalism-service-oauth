<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Services\MySQL\Abstracts\AbstractMySqlTable;
use CarloNicora\Minimalism\Services\MySQL\Interfaces\FieldInterface;
use Exception;

class TokensTable extends AbstractMySqlTable
{
    /** @var string */
    protected static string $tableName = 'tokens';

    /** @var array  */
    protected static array $fields = [
        'tokenId'   => FieldInterface::INTEGER
                    +  FieldInterface::PRIMARY_KEY
                    +  FieldInterface::AUTO_INCREMENT,
        'appId'     => FieldInterface::INTEGER,
        'userId'    => FieldInterface::INTEGER,
        'isUser'    => FieldInterface::INTEGER,
        'token'     => FieldInterface::STRING
    ];

    /**
     * @param string $token
     * @return array
     * @throws Exception
     */
    public function readByToken(
        string $token,
    ): array
    {
        $this->sql = 'SELECT *'
            . ' FROM ' . self::getTableName()
            . ' WHERE token=?;';
        $this->parameters = ['s', $token];

        return $this->functions->runRead();
    }
}