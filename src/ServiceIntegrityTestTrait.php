<?php

namespace Blast\TestUtils;

use Zend\ServiceManager\ServiceManager;

trait ServiceIntegrityTestTrait
{
    /** @var ServiceManager */
    private static $serviceManager;

    /** @var array */
    private static $config;

    private static function createSm()
    {
        self::$config = self::getConfig();
        self::$serviceManager = new ServiceManager(self::$config[self::getServiceManagerConfigKey()]);
        self::$serviceManager->setService('config', self::$config);
    }

    /**
     * Load all available services from module configuration
     * @return array
     */
    public function provideServicesToCheck()
    {
        self::createSm();
        $services = self::$config[$this->getServiceManagerConfigKey()];
        $list = array_merge(
            isset($services['invokables']) ? $services['invokables'] : [],
            isset($services['factories']) ? $services['factories'] : [],
            isset($services['abstract_factories']) ? $services['abstract_factories'] : []
        );

        foreach ($list as $service => $factory) {
            yield [$service];
        }
    }

    /**
     * Check if all configured services can be created
     *
     * @dataProvider provideServicesToCheck
     */
    public function testServiceIntegrity($serviceName)
    {
        $this->assertTrue(self::$serviceManager->has($serviceName));
        $object = self::$serviceManager->get($serviceName);
        if (class_exists($serviceName)) {
            $this->assertInstanceOf($serviceName, $object);
        }
    }
}
