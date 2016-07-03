<?php

namespace Blast\Test\TestUtils\Asset;

use Interop\Container\ContainerInterface;

class BarServiceFactory
{
    public function __invoke(ContainerInterface $container)
    {
        return new BarService($container->get(FooService::class));
    }
}
