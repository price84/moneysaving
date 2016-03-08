<?php

namespace Ed\Msn\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @codeCoverageIgnore
 */
class EdDevelopmentFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('config');
        $edDevelopment = false;

        if (isset($config["edDevelopment"])) {
            $edDevelopment = $config["edDevelopment"];
        }

        return new EdDevelopment($edDevelopment);
    }
}
