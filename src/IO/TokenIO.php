<?php
namespace CarloNicora\Minimalism\Services\OAuth\IO;

use CarloNicora\Minimalism\Interfaces\Data\Abstracts\AbstractIO;
use CarloNicora\Minimalism\Services\OAuth\Data\Token;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\TokensTable;
use Exception;

class TokenIO extends AbstractIO
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
        /** @see TokensTable::readByToken() */
        $recordset = $this->data->read(
            tableInterfaceClassName: TokensTable::class,
            functionName: 'readByToken',
            parameters: [$token],
        );

        return $this->returnSingleObject(
            recordset: $recordset,
            objectType: Token::class,
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
        return $this->returnSingleObject(
            recordset: $this->data->insert(
                tableInterfaceClassName: TokensTable::class,
                records: [$token->export()],
            ),
            objectType: Token::class,
        );
    }
}