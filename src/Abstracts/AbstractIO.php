<?php
namespace CarloNicora\Minimalism\Services\OAuth\Abstracts;

use CarloNicora\Minimalism\Factories\ObjectFactory;
use CarloNicora\Minimalism\Interfaces\Data\Interfaces\DataInterface;
use CarloNicora\Minimalism\Services\OAuth\Interfaces\DataObjectInterface;
use Exception;
use RuntimeException;

abstract class AbstractIO
{
    /**
     * @param ObjectFactory $objectFactory
     * @param DataInterface $data
     */
    public function __construct(
        protected ObjectFactory $objectFactory,
        protected DataInterface $data,
    )
    {
    }

    /**
     * @param array $recordset
     * @param string|null $recordType
     * @return array
     * @throws Exception
     */
    protected function returnSingleValue(
        array $recordset,
        ?string $recordType=null,
    ): array
    {
        if ($recordset === [] || $recordset === [[]]){
            throw new RuntimeException(
                $recordType === null
                    ? 'Record Not found'
                    : $recordType . ' not found'
            );
        }

        return array_is_list($recordset) ? $recordset[0] : $recordset;
    }

    /**
     * @param array $recordset
     * @param string $objectType
     * @return DataObjectInterface
     */
    protected function returnSingleObject(
        array $recordset,
        string $objectType,
    ): DataObjectInterface
    {
        if ($recordset === [] || $recordset === [[]]){
            throw new RuntimeException('Record Not found');
        }

        return new $objectType(
            objectFactory: $this->objectFactory,
            data: array_is_list($recordset) ? $recordset[0] : $recordset,
        );
    }

    /**
     * @param array $recordset
     * @param string $objectType
     * @return DataObjectInterface[]
     */
    protected function returnObjectArray(
        array $recordset,
        string $objectType,
    ): array
    {
        $response = [];

        if (array_is_list($recordset)) {
            foreach ($recordset ?? [] as $record) {
                $response[] = new $objectType(
                    objectFactory: $this->objectFactory,
                    data: $record,
                );
            }
        } else {
            $response[] = new $objectType(
                objectFactory: $this->objectFactory,
                data: $recordset,
            );
        }

        return $response;
    }
}