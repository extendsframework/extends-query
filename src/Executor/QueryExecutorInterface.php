<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;

interface QueryExecutorInterface
{
    /**
     * Execute query message.
     *
     * @param QueryMessageInterface $queryMessage
     * @return CollectionInterface
     */
    public function execute(QueryMessageInterface $queryMessage): CollectionInterface;
}
