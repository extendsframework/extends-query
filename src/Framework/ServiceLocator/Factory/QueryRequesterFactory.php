<?php
declare(strict_types=1);

namespace ExtendsFramework\Query\Framework\ServiceLocator\Factory;

use ExtendsFramework\Query\Requester\QueryRequester;
use ExtendsFramework\Query\Requester\QueryRequesterInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorException;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;

class QueryRequesterFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     * @throws ServiceLocatorException
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $config = $serviceLocator->getConfig();
        $config = $config[QueryRequesterInterface::class] ?? [];

        $requester = new QueryRequester();
        foreach ($config as $executorKey => $payloadNames) {
            $executor = $serviceLocator->getService($executorKey);
            foreach ((array)$payloadNames as $payloadName) {
                /** @noinspection PhpParamsInspection */
                $requester->addQueryExecutor($executor, $payloadName);
            }
        }

        return $requester;
    }
}
