<?php

namespace Ed\Msn\View\Helper;

use Zend\View\Helper\AbstractHelper;

/**
 * Lets us know if we're on the Dev VMs or not
 */
class EdDevelopment extends AbstractHelper
{
    protected $isDevVM;

    /**
     * This just receives one parameter telling it whether we're on the dev VMs or not
     *
     * @param boolean $isDevVM
     */

    public function __construct($isDevVM)
    {
        $this->isDevVM = $isDevVM;
    }

    /**
     * @return \Ed\Ptd\View\Helper\OpenGraph
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * Find that shit out.
     */
    public function isDev()
    {
        return $this->isDevVM;
    }
}
