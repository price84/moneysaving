<?php

namespace Ed\Msn\Controller;

use Ed\Common\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CompetitionController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout()->setVariables([
            // 'headerPath' => 'layout/header-prizes',
            'activeCategory' => 'competitions',
        ]);

        $vm = new ViewModel();

        return $vm->setTemplate('money-saving-news/competitions/index');
    }
}
