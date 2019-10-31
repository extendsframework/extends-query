<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Requester;

use ExtendsFramework\Message\Payload\PayloadInterface;
use ExtendsFramework\Query\Collection\CollectionInterface;
use ExtendsFramework\Query\QueryMessageInterface;
use PHPUnit\Framework\TestCase;

class QueryRequesterAwareTest extends TestCase
{
    /**
     * Request.
     *
     * Test that request method will proxy to the query requester.
     *
     * @covers \ExtendsFramework\Query\Requester\QueryRequesterAware::request()
     */
    public function testRequest(): void
    {
        $collection = $this->createMock(CollectionInterface::class);

        $queryRequester = $this->createMock(QueryRequesterInterface::class);
        $queryRequester
            ->expects($this->once())
            ->method('request')
            ->with($this->isInstanceOf(QueryMessageInterface::class))
            ->willReturn($collection);

        $payload = $this->createMock(PayloadInterface::class);

        $stub = new QueryRequesterAwareStub($queryRequester);

        $this->assertSame($collection, $stub->execute($payload, ['foo' => 'bar']));
    }
}
