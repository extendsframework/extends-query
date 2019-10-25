<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;

class QueryRequesterAwareStub
{
    use QueryRequesterAware;

    /**
     * QueryRequesterAwareStub constructor.
     *
     * @param QueryRequesterInterface $queryRequester
     */
    public function __construct(QueryRequesterInterface $queryRequester)
    {
        $this->queryRequester = $queryRequester;
    }

    /**
     * @param PayloadInterface $payload
     * @param array            $metaData
     * @return CollectionInterface
     * @throws QueryRequesterException
     */
    public function execute(PayloadInterface $payload, array $metaData): CollectionInterface
    {
        return $this->request($payload, $metaData);
    }
}
