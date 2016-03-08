<?php

namespace Ed\Msn\ActionFilter;

use Zend\View\Helper\HeadMeta;
use Zend\View\Helper\HeadTitle;
use Ed\Website\Service\PageService;
use Ed\Common\ActionFilter\ActionFilterInterface;
use Zend\Mvc\MvcEvent;

class Metadata implements ActionFilterInterface
{
    /**
     * @var \Zend\View\Helper\HeadMeta
     */
    private $headMeta;

    /**
     * @var \Zend\View\Helper\HeadTitle
     */
    private $headTitle;

    /**
     * @var \Ed\Website\Service\PageService
     */
    protected $pageService;

    public function __construct(
        HeadMeta $headMeta,
        HeadTitle $headTitle,
        PageService $pageService
    ) {
        $this->headMeta = $headMeta;
        $this->headTitle = $headTitle;
        $this->pageService = $pageService;
    }

    /**
     * (non-PHPdoc)
     * @see \Ed\Common\ActionFilter\ActionFilterInterface::execute()
     */
    public function execute(MvcEvent $e)
    {
        $this->setMetaData();
    }

    /**
     * Setup the various bits of Metadata
     */
    public function setMetaData()
    {
        $this->headMeta->deleteContainer();
        $page = $this->pageService->getPage();

        if ($page && $page->hasPageMetaData()) {
            $this->headMeta->appendName('description', $page->getPageMetaData()->getDescription());
            $this->headTitle->set($page->getPageMetaData()->getTitle());
        } else {
            $this->headTitle->set('MoneySavingNews.com');
        }
    }
}
