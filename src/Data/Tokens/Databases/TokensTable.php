<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Tokens\Databases;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlFieldAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlTableAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldOption;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldType;

#[SqlTableAttribute(name: 'tokens', databaseIdentifier: 'OAuth')]
enum TokensTable
{
    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer, fieldOption: SqlFieldOption::AutoIncrement)]
    case tokenId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case appId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case userId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case isUser;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case token;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case expiration;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String, fieldOption: SqlFieldOption::TimeCreate)]
    case createdAt;
}