<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Framework\ServiceLocator\Factory;

use ExtendsFramework\Query\Executor\QueryExecutorInterface;
use ExtendsFramework\Query\Requester\QueryRequesterInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class QueryRequesterFactoryTest extends TestCase
{
    /**
     * Create service.
     *
     * Test that query requester will be created from config.
     *
     * @covers \ExtendsFramework\Query\Framework\ServiceLocator\Factory\QueryRequesterFactory::createService()
     */
    public function testCreateService(): void
    {
        $executor = $this->createMock(QueryExecutorInterface::class);

        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->method('getConfig')
            ->willReturn([
                QueryRequesterInterface::class => [
                    'FooExecutor' => [
                        'FooQuery',
                        'QuxQuery',
                    ],
                    'BarExecutor' => 'BarQuery',
                ],
            ]);

        $serviceLocator
            ->method('getService')
            ->withConsecutive(
                ['FooExecutor'],
                ['BarExecutor']
            )
            ->willReturn($executor);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $factory = new QueryRequesterFactory();
        $requester = $factory->createService(QueryRequesterInterface::class, $serviceLocator);

        $this->assertInstanceOf(QueryRequesterInterface::class, $requester);
    }
}
