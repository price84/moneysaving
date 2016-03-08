<?php

namespace Ed\Msn\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container as SessionContainer;

/**
 * @codeCoverageIgnore
 */
class SessionFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        return new SessionContainer('moneysavingnewsSession');
    }
}
