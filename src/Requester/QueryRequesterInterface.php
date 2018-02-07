<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Result\ResultInterface;

interface QueryRequesterInterface
{
    /**
     * Request result for query message.
     *
     * @param QueryMessageInterface $queryMessage
     * @return ResultInterface|null
     * @throws QueryRequesterException
     */
    public function request(QueryMessageInterface $queryMessage): ?ResultInterface;
}
