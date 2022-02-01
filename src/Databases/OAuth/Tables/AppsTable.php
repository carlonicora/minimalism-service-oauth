<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum AppsTable: string implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    case tableName='apps';

    case appId='appId';
    case userId='userId';
    case name='name';
    case url='url';
    case isActive='isActive';
    case isTrusted='isTrusted';
    case clientId='clientId';
    case clientSecret='clientSecret';
    case creationTime='creationTime';

    /**
     * @return int
     * @throws Exception
     */
    public function getFieldDefinition(
    ): int
    {
        return match($this) {
            self::appId => FieldType::Integer->value + FieldOption::AutoIncrement->value,
            self::userId,self::isActive,self::isTrusted => FieldType::Integer->value,
            self::name,self::url,self::clientId,self::clientSecret => FieldType::String->value,
            self::creationTime => FieldType::String->value + FieldOption::TimeCreate->value,
            default => throw new Exception(),
        };
    }
}