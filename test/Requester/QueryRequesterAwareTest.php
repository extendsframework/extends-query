<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Result\ResultInterface;
use PHPUnit\Framework\TestCase;

class QueryRequesterAwareTest extends TestCase
{
    /**
     * Request.
     *
     * Test that request method will proxy to the query requester.
     *
     * @covers \ExtendsFramework\Query\Requester\QueryRequesterAware::request()
     * @covers \ExtendsFramework\Query\Requester\QueryRequesterAware::getQueryRequester()
     */
    public function testRequest(): void
    {
        $result = $this->createMock(ResultInterface::class);

        $queryRequester = $this->createMock(QueryRequesterInterface::class);
        $queryRequester
            ->expects($this->once())
            ->method('request')
            ->with($this->isInstanceOf(QueryMessageInterface::class))
            ->willReturn($result);

        $payload = $this->createMock(PayloadInterface::class);

        /**
         * @var QueryRequesterInterface $queryRequester
         * @var PayloadInterface        $payload
         */
        $stub = new QueryRequesterAwareStub($queryRequester);

        $this->assertSame($result, $stub->execute($payload, ['foo' => 'bar']));
    }
}

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
     * @return ResultInterface
     * @throws QueryRequesterException
     */
    public function execute(PayloadInterface $payload, array $metaData): ResultInterface
    {
        return $this->request($payload, $metaData);
    }
}
