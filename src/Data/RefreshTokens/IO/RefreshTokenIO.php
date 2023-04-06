<?php
namespace CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\IO;

use CarloNicora\Minimalism\Exceptions\MinimalismException;
use CarloNicora\Minimalism\Interfaces\Sql\Abstracts\AbstractSqlIO;
use CarloNicora\Minimalism\Interfaces\Sql\Factories\SqlQueryFactory;
use CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\Databases\RefreshTokensTable;
use CarloNicora\Minimalism\Services\OAuth\Data\RefreshTokens\DataObjects\RefreshToken;
use Exception;

class RefreshTokenIO extends AbstractSqlIO
{
    /**
     * @param string $token
     * @return RefreshToken
     * @throws Exception
     */
    public function readByToken(
        string $token,
    ): RefreshToken
    {
        $factory = SqlQueryFactory::create(tableClass: RefreshTokensTable::class)
            ->selectAll()
            ->addParameter(RefreshTokensTable::token, $token);

        return $this->data->read(
            queryFactory: $factory,
            responseType: RefreshToken::class,
        );
    }

    /**
     * @param RefreshToken $token
     * @return RefreshToken
     * @throws Exception
     */
    public function insert(
        RefreshToken $token,
    ): RefreshToken
    {
        return $this->data->create(
            queryFactory: $token,
            responseType: RefreshToken::class,
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
            queryFactory: SqlQueryFactory::create(tableClass: RefreshTokensTable::class)
                ->delete()
                ->addParameter(field: RefreshTokensTable::userId, value: $userId)
        );
    }

    /**
     * @throws MinimalismException
     */
    public function invalidateDescendent(
        int $refreshTokenId,
    ): void
    {
        $this->data->update(
            queryFactory: SqlQueryFactory::create(tableClass: RefreshTokensTable::class)
                ->setSql(
                'WITH RECURSIVE ' .
                    'refresh_tokens_tree(refreshTokenId, parentId) AS ( ' .
                    'SELECT refreshTokenId, parentId ' .
                    'FROM refreshTokens ' .
                    'WHERE refreshTokenId =  ' . $refreshTokenId . ' ' .
                    'UNION ALL ' .
                    'SELECT rt.refreshTokenId, rt.parentId ' .
                    'FROM refreshTokens rt ' .
                    'JOIN refresh_tokens_tree ON rt.parentId = refresh_tokens_tree.refreshTokenId ' .
                    'WHERE rt.parentId IS NOT NULL ' .
                    ') ' .
                    'UPDATE refreshTokens ' .
                    'SET isValid = false ' .
                    'WHERE refreshTokenId IN ( ' .
                    'SELECT refreshTokenId ' .
                    'FROM refresh_tokens_tree ' .
                    ');')
        );
    }
}