<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\Tokens\IO;

use CarloNicora\Minimalism\Exceptions\MinimalismException;
use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Interfaces\Sql\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\Cache\TokenCacheFactory;
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
        $factory = SqlQueryFactory::create(tableClass: TokensTable::class)
            ->selectAll()
            ->addParameter(TokensTable::token, $token);

        return $this->data->read(
            queryFactory: $factory,
            cacheBuilder: TokenCacheFactory::token($token),
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
            cacheBuilder: TokenCacheFactory::token($token->getToken()),
            responseType: Token::class,
        );
    }

    /**
     * @param int $userId
     * @return void
     * @throws MinimalismException
     */
    public function deleteByUserId(
        int $userId
    ): void
    {
        $this->data->delete(
            queryFactory: SqlQueryFactory::create(tableClass: TokensTable::class)
                ->delete()
                ->addParameter(field: TokensTable::userId, value: $userId)
        );
    }

}