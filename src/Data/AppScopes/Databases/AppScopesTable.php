<?php

namespace CarloNicora\Minimalism\Services\OAuth\Data\AppScopes\Databases;

use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlTable;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;

#[SqlTable(name: 'appScopes', databaseIdentifier: 'OAuth')]
enum AppScopesTable
{
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::PrimaryKey)]
    case appId;

    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::PrimaryKey)]
    case scopeId;

}