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
    protected $queryExecutors = [];

    /**
     * @inheritDoc
     */
    public function request(QueryMessageInterface $queryMessage): CollectionInterface
    {
        return $this
            ->getQueryExecutor($queryMessage)
            ->execute($queryMessage);
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

    /**
     * Get query executor.
     *
     * @param QueryMessageInterface $queryMessage
     * @return QueryExecutorInterface
     * @throws QueryExecutorNotFound When no query executor can be found for query message.
     */
    protected function getQueryExecutor(QueryMessageInterface $queryMessage): QueryExecutorInterface
    {
        $queryExecutors = $this->getQueryExecutors();
        $name = $queryMessage
            ->getPayloadType()
            ->getName();

        if (!array_key_exists($name, $queryExecutors)) {
            throw new QueryExecutorNotFound($queryMessage);
        }

        return $queryExecutors[$name];
    }

    /**
     * Get query executors.
     *
     * @return QueryExecutorInterface[]
     */
    protected function getQueryExecutors(): array
    {
        return $this->queryExecutors;
    }
}
