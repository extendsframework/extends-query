<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Message\Payload\PayloadMethodTrait;
use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;

abstract class AbstractQueryExecutor implements QueryExecutorInterface
{
    use PayloadMethodTrait;

    /**
     * Query message.
     *
     * @var QueryMessageInterface
     */
    protected $queryMessage;

    /**
     * @inheritDoc
     */
    public function execute(QueryMessageInterface $queryMessage): CollectionInterface
    {
        $this->queryMessage = $queryMessage;

        return $this->getMethod($queryMessage, 'execute')($queryMessage->getPayload());
    }

    /**
     * Get query message.
     *
     * @return QueryMessageInterface
     */
    protected function getQueryMessage(): QueryMessageInterface
    {
        return $this->queryMessage;
    }
}
