<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Executor;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Message\Payload\Type\PayloadTypeInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use ExtendsFramework\Query\Result\ResultInterface;
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

        $result = $this->createMock(ResultInterface::class);

        /**
         * @var ResultInterface       $result
         * @var QueryMessageInterface $message
         */
        $handler = new ExecutorStub($result);

        $this->assertSame($result, $handler->execute($message));
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
     * @var ResultInterface
     */
    protected $result;

    /**
     * ExecutorStub constructor.
     *
     * @param ResultInterface $result
     */
    public function __construct(ResultInterface $result)
    {
        $this->result = $result;
    }

    /**
     * @param PayloadInterface $payload
     * @return ResultInterface
     */
    public function executePayloadStub(PayloadInterface $payload): ResultInterface
    {
        $this->payload = $payload;

        return $this->result;
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
