<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum AppScopesTable: string implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    case tableName='appScopes';

    case appId='appId';
    case scopeId='scopeId';

    /**
     * @return int
     * @throws Exception
     */
    public function getFieldDefinition(
    ): int
    {
        return match($this) {
            self::appId,self::scopeId => FieldType::Integer->value + FieldOption::PrimaryKey->value,
            default => throw new Exception(),
        };
    }
}