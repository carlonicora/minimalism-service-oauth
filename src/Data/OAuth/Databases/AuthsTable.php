<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\OAuth\Databases;

use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlTable;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;

#[SqlTable(name: 'auths',databaseIdentifier: 'OAuth')]
enum AuthsTable
{
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::AutoIncrement)]
    case authId;

    #[SqlField(fieldType: FieldType::Integer)]
    case appId;

    #[SqlField(fieldType: FieldType::Integer)]
    case userId;

    #[SqlField(fieldType: FieldType::String)]
    case expiration;

    #[SqlField(fieldType: FieldType::String)]
    case code;
}