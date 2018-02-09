<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Framework\ServiceLocator\Loader;

use ExtendsFramework\Query\Requester\QueryRequesterInterface;
use ExtendsFramework\Query\Framework\ServiceLocator\Factory\QueryRequesterFactory;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class QueryConfigLoaderTest extends TestCase
{
    /**
     * Load.
     *
     * Test that correct config will be loaded.
     *
     * @covers \ExtendsFramework\Query\Framework\ServiceLocator\Loader\QueryConfigLoader::load()
     */
    public function testLoad(): void
    {
        $loader = new QueryConfigLoader();

        $this->assertSame([
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    QueryRequesterInterface::class => QueryRequesterFactory::class,
                ],
            ],
            QueryRequesterInterface::class => [],
        ], $loader->load());
    }
}
