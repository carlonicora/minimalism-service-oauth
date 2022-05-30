<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\UserScopes\Databases;

use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlTable;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;

#[SqlTable(name: 'userScopes',databaseIdentifier: 'OAuth')]
enum UserScopesTable
{
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::AutoIncrement)]
    case userScopeId;

    #[SqlField(fieldType: FieldType::Integer)]
    case userId;

    #[SqlField(fieldType: FieldType::Integer)]
    case appId;

    #[SqlField(fieldType: FieldType::Integer)]
    case scopeId;
}