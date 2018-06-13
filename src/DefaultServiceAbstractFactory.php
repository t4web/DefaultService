<?php

namespace T4web\DefaultService;

use Zend\ServiceManager\Factory\AbstractFactoryInterface;
use Interop\Container\ContainerInterface;

class DefaultServiceAbstractFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        if (!is_string($requestedName)) {
            return false;
        }

        $factoryName = $requestedName . "Factory";
        if (class_exists($factoryName)) {
            return true;
        }

        return class_exists($requestedName);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $factoryName = $requestedName . "Factory";
        if (class_exists($factoryName)) {
            $factory = new $factoryName();

            return $factory->createService($serviceManager);
        }

        return new $requestedName();
    }
}
