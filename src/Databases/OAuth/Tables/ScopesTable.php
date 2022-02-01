<?php
namespace CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables;

use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlFieldInterface;
use CarloNicora\Minimalism\Interfaces\Sql\Interfaces\SqlTableInterface;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlFieldTrait;
use CarloNicora\Minimalism\Services\MySQL\Traits\SqlTableTrait;
use Exception;

enum ScopesTable: string implements SqlTableInterface, SqlFieldInterface
{
    use SqlTableTrait;
    use SqlFieldTrait;

    case tableName='scopes';

    case scopeId='scopeId';
    case name='name';

    /**
     * @return int
     * @throws Exception
     */
    public function getFieldDefinition(
    ): int
    {
        return match($this) {
            self::scopeId => FieldType::Integer->value + FieldOption::AutoIncrement->value,
            self::name => FieldType::String->value,
            default => throw new Exception(),
        };
    }
}