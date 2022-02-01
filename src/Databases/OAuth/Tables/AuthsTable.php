<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum AuthsTable: string implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    case tableName='auths';

    case authId='authId';
    case appId='appId';
    case userId='userId';
    case expiration='expiration';
    case code='code';

    /**
     * @return int
     * @throws Exception
     */
    public function getFieldDefinition(
    ): int
    {
        return match($this) {
            self::authId => FieldType::Integer->value + FieldOption::AutoIncrement->value,
            self::userId,self::appId => FieldType::Integer->value,
            self::expiration,self::code => FieldType::String->value,
            default => throw new Exception(),
        };
    }
}