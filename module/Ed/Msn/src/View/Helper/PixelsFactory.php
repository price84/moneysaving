<?php

namespace Ed\Msn\View\Helper;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @codeCoverageIgnore
 */
class PixelsFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $session = $serviceLocator->getServiceLocator()->get('session');
        $applicationService = $serviceLocator->getServiceLocator()->get('\Ed\Applications\Service\ApplicationService');
        $trackingService = $serviceLocator->getServiceLocator()->get('\Ed\Hits\Service\TrackingService');
        $pageService = $serviceLocator->getServiceLocator()->get('\Ed\Website\Service\PageService');
        $pixelProvider = $serviceLocator->getServiceLocator()->get('\Ed\Pixels\Service\PixelProvider');
        $config = $serviceLocator->getServiceLocator()->get('config');
        $edDevelopment = false;

        if (isset($config["edDevelopment"])) {
            $edDevelopment = $config["edDevelopment"];
        }

        return new Pixels($session, $applicationService, $pageService, $trackingService, $pixelProvider, $edDevelopment);
    }
}
