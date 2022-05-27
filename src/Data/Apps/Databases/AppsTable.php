<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Apps\Databases;

use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlTable;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;

#[SqlTable(name: 'apps', databaseIdentifier: 'OAuth')]
enum AppsTable
{
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::AutoIncrement)]
    case appId;

    #[SqlField(fieldType: FieldType::Integer)]
    case userId;

    #[SqlField(fieldType: FieldType::String)]
    case name;

    #[SqlField(fieldType: FieldType::String)]
    case url;

    #[SqlField(fieldType: FieldType::Integer)]
    case isActive;

    #[SqlField(fieldType: FieldType::Integer)]
    case isTrusted;

    #[SqlField(fieldType: FieldType::String)]
    case clientId;


    #[SqlField(fieldType: FieldType::String)]
    case clientSecret;

    #[SqlField(fieldType: FieldType::String, fieldOption: FieldOption::TimeCreate)]
    case createdAt;

}