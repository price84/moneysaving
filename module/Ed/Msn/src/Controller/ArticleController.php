<?php

namespace Ed\Msn\Controller;

use Ed\Common\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Config\Config;

class ArticleController extends AbstractActionController
{
    /**
     * $config
     * @var array
     */
    protected $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function indexAction()
    {
        $category = $this->getEvent()->getRouteMatch()->getParam('category');

        $this->layout()->setVariables([
            'activeCategory' => $category,
        ]);

        $vm = new ViewModel([
            'category' => $category
        ]);

        return $vm->setTemplate('money-saving-news/article/index');
    }

    public function articleAction()
    {
        $article = $this->getEvent()->getRouteMatch()->getParam('article');
        $subId = $this->getRequest()->getQuery('utm_content');
        $trackingCode = $this->getRequest()->getQuery('tracking');
        $articleData = $this->getArticleData($article);

        $vm = new ViewModel();

        // Set Tracking code - Querystring takes preference over stored article data
        if ($trackingCode && $trackingCode != '') {
            $this->layout()->setVariable('trackingCode', $trackingCode);
            $vm->setVariable('trackingCode', $trackingCode);
        } elseif ($articleData && isset($articleData['trackingCode'])) {
            $this->layout()->setVariable('trackingCode', $articleData['trackingCode']);
            $vm->setVariable('trackingCode', $articleData['trackingCode']);
        }

        // Set sub Id
        if ($subId && $subId != '') {
            $this->layout()->setVariable('subId', $subId);
            $vm->setVariable('subId', $subId);
        }

        // Set article data
        if ($articleData) {
            // Set article category and advertorial flag
            $this->layout()->setVariables([
                'activeCategory' => (isset($articleData['category'])) ? $articleData['category'] : '',
                'isAdvertorial' => (isset($articleData['isAdvertorial'])) ? $articleData['isAdvertorial'] : false,
            ]);

            $vm->setVariables([
                'articleDate' => (isset($articleData['date'])) ? $articleData['date'] : 'now',
                'articleLinkText' => (isset($articleData['linkText'])) ? $articleData['linkText'] : '',
            ]);
        }

        return $vm->setTemplate('money-saving-news/article/' . $article);
    }

    /**
     * Return article data (or landing page data) from config file
     *
     * @param string $article article title
     * @return mixed array|false
     */
    private function getArticleData($article)
    {
        if (array_key_exists($article, $this->config['msn']['articles'])) {
            return $this->config['msn']['articles'][$article];
        } else if (array_key_exists($article, $this->config['msn']['landingPages'])) {
            return $this->config['msn']['landingPages'][$article];
        } else {
            return false;
        }
    }
}
