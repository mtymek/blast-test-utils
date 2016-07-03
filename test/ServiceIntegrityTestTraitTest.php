<?php

namespace Blast\Test\TestUtils;

use Blast\Test\TestUtils\Asset\BarService;
use Blast\Test\TestUtils\Asset\BarServiceFactory;
use Blast\Test\TestUtils\Asset\FooService;
use Blast\TestUtils\ServiceIntegrityTestTrait;
use PHPUnit_Framework_TestCase;

class ServiceIntegrityTestTraitTest extends PHPUnit_Framework_TestCase
{
    use ServiceIntegrityTestTrait;

    public static function getConfig()
    {
        return [
            'dependencies' => [
                'invokables' => [
                    FooService::class => FooService::class,
                ],
                'factories' => [
                    BarService::class => BarServiceFactory::class,
                ],
            ],
        ];
    }

    public static function getServiceManagerConfigKey()
    {
        return 'dependencies';
    }
}
