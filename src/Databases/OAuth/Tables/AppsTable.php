<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum AppsTable implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    public const tableName='apps';

    case appId;
    case userId;
    case name;
    case url;
    case isActive;
    case isTrusted;
    case clientId;
    case clientSecret;
    case creationTime;

    /**
     * @return int
     * @throws Exception
     */
    public function getFieldDefinition(
    ): int
    {
        return match($this) {
            self::appId => FieldOption::AutoIncrement->value,
            self::userId,self::isActive,self::isTrusted => FieldType::Integer->value,
            self::name,self::url,self::clientId,self::clientSecret => FieldType::String->value,
            self::creationTime => FieldOption::TimeCreate->value,
        };
    }
}