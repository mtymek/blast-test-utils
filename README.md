Blast\TestUtils
===============

[![Build Status](https://travis-ci.org/mtymek/blast-test-utils.svg?branch=master)](https://travis-ci.org/mtymek/blast-test-utils)

**Utilities for testing integrity of services managed by Zend\\ServiceManager.**

## Installation

Install this library using composer:

```
$ composer require mtymek/blast-test-utils
```

## Usage

Use `ServiceIntegrityTestTrait` to build test that validates integrity of your service manager configuration.
It requires to static methos: `getConfig` that loads full application config, and `getServiceManagerConfigKey`
providing name of configuration key used to set up ServiceManager. 


Example usage for `zend-expressive` application:

```php
<?php

namespace Integration;

use Blast\TestUtils\ServiceIntegrityTestTrait;
use PHPUnit_Framework_TestCase;

class ServiceContainerIntegrityTest extends PHPUnit_Framework_TestCase
{
    use ServiceIntegrityTestTrait;

    private static function getConfig()
    {
        return include 'config/config.php';
    }

    private static function getServiceManagerConfigKey()
    {
        return 'dependencies';
    }
}
```
