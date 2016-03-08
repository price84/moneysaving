<?php

namespace Ed\Msn\View\Helper;

use Zend\View\Helper\AbstractHelper;

class ReferralLink extends AbstractHelper
{
    public function __invoke()
    {
        return $this;
    }

    /**
     * Create referral link to protected.co.uk website
     * @param  string $trackingCode 
     * @param  string $subId
     * @return string referral url with querystring parameters
     */
    public function createLink($trackingCode = '', $subId = '')
    {
        $parameters = [];
        $link = "http://www.protected.co.uk/";

        if (!empty($trackingCode)) {
            $parameters['tracking'] = $trackingCode;
        }
        if (!empty($subId)) {
            $parameters['sub_id'] = $subId;
        }

        if (count($parameters) > 0) {
            return $link . "?" . http_build_query($parameters);
        } else {
            return $link;
        }
    }
}
