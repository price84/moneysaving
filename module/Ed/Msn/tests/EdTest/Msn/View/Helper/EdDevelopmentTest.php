<?php
namespace EdTest\Msn\View\Helper;

use PHPUnit_Framework_TestCase;
use Ed\Msn\View\Helper\EdDevelopment;

class EdDevelopmentTest extends PHPUnit_Framework_TestCase
{
    public function testIsDev()
    {
        $devHelper = new EdDevelopment(true);
        $this->assertTrue($devHelper->isDev());

        $liveHelper = new EdDevelopment(false);
        $this->assertFalse($liveHelper->isDev());
    }
}
