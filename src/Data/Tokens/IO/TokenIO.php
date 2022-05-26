<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Tokens\IO;

use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Services\MySQL\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\Databases\TokensTable;
use CarloNicora\Minimalism\Services\OAuth\Data\Tokens\DataObjects\Token;
use Exception;

class TokenIO extends AbstractSqlIO
{
    /**
     * @param string $token
     * @return Token
     * @throws Exception
     */
    public function readByToken(
        string $token,
    ): Token
    {
        $factory = SqlQueryFactory::create(TokensTable::class)
            ->selectAll()
            ->addParameter(TokensTable::token, $token);

        return $this->data->read(
            queryFactory: $factory,
            responseType: Token::class,
        );
    }

    /**
     * @param Token $token
     * @return Token
     * @throws Exception
     */
    public function insert(
        Token $token,
    ): Token
    {
        return $this->data->create(
            queryFactory: $token,
            responseType: Token::class,
        );
    }
}