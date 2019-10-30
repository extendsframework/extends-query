<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Query\Collection\CollectionInterface;
use ExtendsFramework\Query\Executor\QueryExecutorInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Requester\Exception\QueryExecutorNotFound;

class QueryRequester implements QueryRequesterInterface
{
    /**
     * Query executors.
     *
     * @var QueryExecutorInterface[]
     */
    private $queryExecutors = [];

    /**
     * @inheritDoc
     */
    public function request(QueryMessageInterface $queryMessage): CollectionInterface
    {
        $name = $queryMessage
            ->getPayloadType()
            ->getName();

        if (!array_key_exists($name, $this->queryExecutors)) {
            throw new QueryExecutorNotFound($queryMessage);
        }

        return $this->queryExecutors[$name]->execute($queryMessage);
    }

    /**
     * Add query executor.
     *
     * @param QueryExecutorInterface $queryExecutor
     * @param string                 $payloadName
     * @return QueryRequester
     */
    public function addQueryExecutor(QueryExecutorInterface $queryExecutor, string $payloadName): QueryRequester
    {
        $this->queryExecutors[$payloadName] = $queryExecutor;

        return $this;
    }
}
