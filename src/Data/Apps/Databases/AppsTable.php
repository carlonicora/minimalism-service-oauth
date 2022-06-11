<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Apps\Databases;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlFieldAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlTableAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldOption;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldType;

#[SqlTableAttribute(name: 'apps', databaseIdentifier: 'OAuth')]
enum AppsTable
{
    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer, fieldOption: SqlFieldOption::AutoIncrement)]
    case appId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case userId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case name;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case url;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case isActive;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case isTrusted;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case clientId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case clientSecret;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String, fieldOption: SqlFieldOption::TimeCreate)]
    case createdAt;
}