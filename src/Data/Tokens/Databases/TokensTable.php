<?php

namespace CarloNicora\Minimalism\Services\OAuth\Data\Tokens\Databases;

use CarloNicora\Minimalism\Services\MySQL\Data\SqlField;
use CarloNicora\Minimalism\Services\MySQL\Data\SqlTable;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldOption;
use CarloNicora\Minimalism\Services\MySQL\Enums\FieldType;

#[SqlTable(name: 'tokens', databaseIdentifier: 'OAuth')]
enum TokensTable
{
    #[SqlField(fieldType: FieldType::Integer, fieldOption: FieldOption::AutoIncrement)]
    case tokenId;

    #[SqlField(fieldType: FieldType::Integer)]
    case appId;

    #[SqlField(fieldType: FieldType::Integer)]
    case userId;

    #[SqlField(fieldType: FieldType::Integer)]
    case isUser;

    #[SqlField(fieldType: FieldType::String)]
    case token;
}