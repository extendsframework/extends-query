<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;
use ExtendsFramework\Query\QueryMessageInterface;

class ExecutorStub extends AbstractQueryExecutor
{
    /**
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * @var CollectionInterface
     */
    protected $collection;

    /**
     * ExecutorStub constructor.
     *
     * @param CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param PayloadInterface $payload
     * @return CollectionInterface
     */
    public function executePayloadStub(PayloadInterface $payload): CollectionInterface
    {
        $this->payload = $payload;

        return $this->collection;
    }

    /**
     * @return QueryMessageInterface
     */
    public function getQueryMessage(): QueryMessageInterface
    {
        return parent::getQueryMessage();
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
