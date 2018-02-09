<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Framework\ServiceLocator\Loader;

use ExtendsFramework\Query\Framework\ServiceLocator\Factory\QueryRequesterFactory;
use ExtendsFramework\Query\Requester\QueryRequesterInterface;
use ExtendsFramework\ServiceLocator\Config\Loader\LoaderInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;

class QueryConfigLoader implements LoaderInterface
{
    /**
     * @inheritDoc
     */
    public function load(): array
    {
        return [
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    QueryRequesterInterface::class => QueryRequesterFactory::class,
                ],
            ],
            QueryRequesterInterface::class => [],
        ];
    }
}
