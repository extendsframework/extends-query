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
    private $queryRequester;

    /**
     * Dispatch new query message.
     *
     * @param PayloadInterface $payload
     * @param array|null       $metaData
     * @return CollectionInterface
     * @throws QueryRequesterException
     */
    private function request(PayloadInterface $payload, array $metaData = null): CollectionInterface
    {
        return $this->queryRequester->request(
            new QueryMessage(
                $payload,
                new PayloadType($payload),
                $metaData
            )
        );
    }
}
