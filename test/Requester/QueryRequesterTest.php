<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use ExtendsFramework\Query\Executor\QueryExecutorInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Requester\Exception\QueryExecutorNotFound;
use PHPUnit\Framework\TestCase;

class QueryRequesterTest extends TestCase
{
    /**
     * Request.
     *
     * Test that ...
     *
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::addQueryExecutor()
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::request()
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::getQueryExecutors()
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::getQueryExecutor()
     */
    public function testRequest(): void
    {
        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadBar');

        $message = $this->createMock(QueryMessageInterface::class);
        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $executor = $this->createMock(QueryExecutorInterface::class);
        $executor
            ->expects($this->once())
            ->method('execute')
            ->with($message);

        /**
         * @var QueryExecutorInterface $executor
         * @var QueryMessageInterface  $message
         */
        $requester = new QueryRequester();
        $requester
            ->addQueryExecutor($executor, 'PayloadFoo')
            ->addQueryExecutor($executor, 'PayloadBar')
            ->request($message);
    }

    /**
     * Query executor not found.
     *
     * Test that and exception will be thrown when there is no query executor for the query message.
     *
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::addQueryExecutor()
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::request()
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::getQueryExecutor()
     * @covers \ExtendsFramework\Query\Requester\QueryRequester::getQueryExecutors()
     * @covers \ExtendsFramework\Query\Requester\Exception\QueryExecutorNotFound::__construct()
     */
    public function testQueryExecutorNotFound(): void
    {
        $this->expectException(QueryExecutorNotFound::class);
        $this->expectExceptionMessage('No query executor found for query message payload name "PayloadBar".');

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadBar');

        $message = $this->createMock(QueryMessageInterface::class);
        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $executor = $this->createMock(QueryExecutorInterface::class);
        $executor
            ->expects($this->never())
            ->method('execute');

        /**
         * @var QueryExecutorInterface $executor
         * @var QueryMessageInterface  $message
         */
        $requester = new QueryRequester();
        $requester
            ->addQueryExecutor($executor, 'PayloadFoo')
            ->request($message);
    }
}
