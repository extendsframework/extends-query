<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadType;
use ExtendsFramework\Query\QueryMessage;
use ExtendsFramework\Query\Result\ResultInterface;

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
     * @return ResultInterface
     * @throws QueryRequesterException
     */
    protected function request(PayloadInterface $payload, array $metaData = null): ResultInterface
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
