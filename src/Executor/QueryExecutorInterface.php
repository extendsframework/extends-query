<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Result\ResultInterface;

interface QueryExecutorInterface
{
    /**
     * Execute query message.
     *
     * @param QueryMessageInterface $queryMessage
     * @return ResultInterface|null
     */
    public function execute(QueryMessageInterface $queryMessage): ?ResultInterface;
}
