<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadType;
use ExtendsFramework\Query\Collection\CollectionInterface;
use ExtendsFramework\Query\QueryMessage;

trait QueryRequesterAware
{
    /**
     * Query requester.
     *
     * @var QueryRequesterInterface
     */
    protected $queryRequester;

    /**
     * Dispatch new query message.
     *
     * @param PayloadInterface $payload
     * @param array|null       $metaData
     * @return CollectionInterface
     * @throws QueryRequesterException
     */
    protected function request(PayloadInterface $payload, array $metaData = null): CollectionInterface
    {
        return $this
            ->getQueryRequester()
            ->request(
                new QueryMessage(
                    $payload,
                    new PayloadType($payload),
                    $metaData
                )
            );
    }

    /**
     * Get query requester.
     *
     * @return QueryRequesterInterface
     */
    protected function getQueryRequester(): QueryRequesterInterface
    {
        return $this->queryRequester;
    }
}
