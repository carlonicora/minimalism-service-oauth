<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum TokensTable: string implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    case tableName='tokens';

    case tokenId='tokenId';
    case appId='appId';
    case userId='userId';
    case isUser='isUser';
    case token='token';

    /**
     * @return int
     * @throws Exception
     */
    public function getFieldDefinition(
    ): int
    {
        return match($this) {
            self::tokenId => FieldType::Integer->value + FieldOption::AutoIncrement->value,
            self::userId,self::appId,self::isUser => FieldType::Integer->value,
            self::token => FieldType::String->value,
            default => throw new Exception(),
        };
    }
}