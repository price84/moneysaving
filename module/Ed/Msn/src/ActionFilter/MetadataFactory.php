<?php

namespace Ed\Msn\ActionFilter;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MetadataFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $viewHelperManager = $serviceLocator->get('viewhelpermanager');
        $headMeta = $viewHelperManager->get('headMeta');
        $headTitle = $viewHelperManager->get('headTitle');
        $pageService = $serviceLocator->get('\Ed\Website\Service\PageService');

        return new Metadata($headMeta, $headTitle, $pageService);
    }
}
