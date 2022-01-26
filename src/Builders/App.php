<?php
namespace CarloNicora\Minimalism\Services\OAuth\Builders;

use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataFunctionInterface;
use CarloNicora\Minimalism\Interfaces\Data\Objects\DataFunction;
use CarloNicora\Minimalism\Services\Builder\Abstracts\AbstractResourceBuilder;
use CarloNicora\Minimalism\Services\Builder\Objects\RelationshipBuilder;
use CarloNicora\Minimalism\Services\OAuth\Databases\OAuth\Tables\ScopesTable;
use Exception;

class App extends AbstractResourceBuilder
{
    /** @var string  */
    public string $type = 'app';

    /**
     * @param array $data
     * @throws Exception
     */
    public function setAttributes(
        array $data
    ): void
    {
        $this->response->id = $this->encrypter->encryptId($data['appId']);

        $this->response->attributes->add('name', $data['name']);
    }

    /**
     * @return array|null
     */
    public function getRelationshipReaders(): ?array
    {
        $response = [];

        /** @see ScopesTable::byAppId() */
        $response[] = new RelationshipBuilder(
            name: 'scopes',
            builderClassName: Scope::class,
            function: new DataFunction(
                type: DataFunctionInterface::TYPE_TABLE,
                className: ScopesTable::class,
                functionName: 'byAppId',
                parameters: ['appId']
            )
        );

        return $response;
    }
}