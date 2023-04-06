<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\Databases;

use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlFieldAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Attributes\SqlTableAttribute;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldOption;
use CarloNicora\Minimalism\Interfaces\Sql\Enums\SqlFieldType;

#[SqlTableAttribute(name: 'refreshTokens', databaseIdentifier: 'OAuth')]
enum RefreshTokensTable
{
    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer, fieldOption: SqlFieldOption::AutoIncrement)]
    case refreshTokenId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case parentId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case appId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case userId;

    #[SqlFieldAttribute(fieldType: SqlFieldType::String)]
    case token;

    #[SqlFieldAttribute(fieldType: SqlFieldType::Integer)]
    case isValid;
}