<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;
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

        /**
         * @var CollectionInterface   $collection
         * @var QueryMessageInterface $message
         */
        $handler = new ExecutorStub($collection);

        $this->assertSame($collection, $handler->execute($message));
        $this->assertSame($payload, $handler->getPayload());
        $this->assertSame($message, $handler->getQueryMessage());
    }
}

class ExecutorStub extends AbstractQueryExecutor
{
    /**
     * @var PayloadInterface
     */
    protected $payload;

    /**
     * @var CollectionInterface
     */
    protected $collection;

    /**
     * ExecutorStub constructor.
     *
     * @param CollectionInterface $collection
     */
    public function __construct(CollectionInterface $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param PayloadInterface $payload
     * @return CollectionInterface
     */
    public function executePayloadStub(PayloadInterface $payload): CollectionInterface
    {
        $this->payload = $payload;

        return $this->collection;
    }

    /**
     * @return QueryMessageInterface
     */
    public function getQueryMessage(): QueryMessageInterface
    {
        return parent::getQueryMessage();
    }

    /**
     * @return PayloadInterface
     */
    public function getPayload(): PayloadInterface
    {
        return $this->payload;
    }
}
