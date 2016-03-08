<?php

namespace Ed\Msn\Controller;

use Ed\Common\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $vm = new ViewModel();
        return $vm->setTemplate('money-saving-news/index/v1');
    }

    public function termsAndConditionsAction()
    {
        $vm = new ViewModel();
        return $vm->setTemplate('money-saving-news/index/terms-and-conditions');
    }

    public function privacyPolicyAction()
    {
        $vm = new ViewModel();
        return $vm->setTemplate('money-saving-news/index/privacy-policy');
    }

    public function contactAction()
    {
        $vm = new ViewModel();
        return $vm->setTemplate('money-saving-news/index/contact');
    }
}
