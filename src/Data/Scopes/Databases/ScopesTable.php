<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Scopes\Databases;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlFieldAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlTableAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldOption;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldType;

#[SqlTableAttribute(name: 'scopes', databaseIdentifier: 'OAuth')]
enum ScopesTable
{
    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer, fieldOption: SqlFieldOption::AutoIncrement)]
    case scopeId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case name;
}