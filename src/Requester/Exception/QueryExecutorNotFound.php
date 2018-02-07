<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester\Exception;

use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Requester\QueryRequesterException;
use InvalidArgumentException;

class QueryExecutorNotFound extends InvalidArgumentException implements QueryRequesterException
{
    /**
     * QueryExecutorNotFound constructor.
     *
     * @param QueryMessageInterface $queryMessage
     */
    public function __construct(QueryMessageInterface $queryMessage)
    {
        parent::__construct(sprintf(
            'No query executor found for query message payload name "%s".',
            $queryMessage
                ->getPayloadType()
                ->getName()
        ));
    }
}
