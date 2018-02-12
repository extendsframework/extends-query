<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;

interface QueryRequesterInterface
{
    /**
     * Request result for query message.
     *
     * @param QueryMessageInterface $queryMessage
     * @return CollectionInterface
     * @throws QueryRequesterException
     */
    public function request(QueryMessageInterface $queryMessage): CollectionInterface;
}
