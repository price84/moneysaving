<?php

namespace EdTest\Msn;

$autoloadPaths = [
    '../../autoload.php',
    'vendor/autoload.php',
    '../vendor/autoload.php',
];

foreach ($autoloadPaths as $path) {
    if (file_exists($path)) {
        require $path;
        break;
    }
}

use Ed\Testing\AbstractBootstrap;

class Bootstrap extends AbstractBootstrap
{
    public static function getModulesToLoad()
    {
        return [
            'Ed\Msn',
        ];
    }

    public static function getDoctrineEntityPaths($vendorDir)
    {
        return [];
    }
}

Bootstrap::init();
