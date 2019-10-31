<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use PHPUnit\Framework\TestCase;

class AbstractQueryExecutorTest extends TestCase
{
    /**
     * Execute.
     *
     * Test that query message will be executed by the correct method.
     *
     * @covers \ExtendsFramework\Query\Executor\AbstractQueryExecutor::execute()
     * @covers \ExtendsFramework\Query\Executor\AbstractQueryExecutor::getQueryMessage()
     */
    public function testExecute(): void
    {
        $payload = $this->createMock(PayloadInterface::class);

        $payloadType = $this->createMock(PayloadTypeInterface::class);
        $payloadType
            ->method('getName')
            ->willReturn('PayloadStub');

        $message = $this->createMock(QueryMessageInterface::class);
        $message
            ->method('getPayload')
            ->willReturn($payload);

        $message
            ->method('getPayloadType')
            ->willReturn($payloadType);

        $collection = $this->createMock(CollectionInterface::class);

        $handler = new ExecutorStub($collection);

        $this->assertSame($collection, $handler->execute($message));
        $this->assertSame($payload, $handler->getPayload());
        $this->assertSame($message, $handler->getQueryMessage());
    }
}
