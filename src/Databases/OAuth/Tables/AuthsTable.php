<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum AuthsTable implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    public const tableName='auths';

    case authId;
    case appId;
    case userId;
    case expiration;
    case code;

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
        };
    }
}