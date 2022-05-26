<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Scopes\Databases;

use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlTable;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;

#[SqlTable(name: 'scopes',databaseIdentifier: 'OAuth')]
enum ScopesTable
{
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::AutoIncrement)]
    case scopeId;

    #[SqlField(fieldType: FieldType::String)]
    case name;
}