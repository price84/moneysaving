<?php

$modules = [
    'ZfcRbac',
    'DoctrineModule',
    'DoctrineORMModule',
    'Ed\Amqp',
    'Ed\Log',
    'Ed\Common',
    'Ed\Website',
    'Ed\Webservices',
    'Ed\Products',
    'Ed\Advertisers',
    'Ed\Applications',
    'Ed\Comparisons',
    'Ed\Form',
    'Ed\Hits',
    'Ed\Partners',
    'Ed\SubmittedClient',
    'Ed\ReportedClient',
    'Ed\Tracker',
    'Ed\DataFilters',
    'Ed\Unsubscribes',
    'Ed\Auth',
    'Ed\Mail',
    'Ed\Pixels',
    'Ed\WlpTest',
    'Ed\MarketingEmails',
    'Ed\PhoneService',
    'Ed\Msn',
];

if (in_array(strtolower(getenv('ED_DEVELOPMENT')), ['1', 'true', 'yes'])) {
    $modules[] = 'ZendDeveloperTools';
}

return [
    // This should be an array of module namespaces used in the application.
    'modules' => $modules,
    'module_listener_options' => [
        'module_paths' => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
