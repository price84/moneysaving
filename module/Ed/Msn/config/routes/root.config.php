<?php
return [
    'type' => 'Segment',
    'options' => [
        'route' => '[/]',
        'defaults' => [
            '__NAMESPACE__' => 'Ed\Msn\Controller',
            'controller' => 'Index',
            'action' => 'index',
        ],
    ],
    'may_terminate' => true,
    'child_routes' => [
        /* Article Categories */
        'articles' => [
            'type' => 'Segment',
            'options' => [
                'route' => 'articles[/:category]',
                'constraints' => [
                    'category' => 'career|finance|health-and-beauty|lifestyle|relationship|technology|travel',
                ],
                'defaults' => [
                    'controller' => 'Article',
                    'action' => 'Index',
                    'category' => ''
                ],
            ],
        ],
        /* Article */
        'article' => [
            'type' => 'Segment',
            'options' => [
                'route' => 'article/:article',
                'constraints' => [
                    'article' => '[a-zA-Z0-9-]+',
                ],
                'defaults' => [
                    'controller' => 'Article',
                    'action' => 'article',
                    'article' => ''
                ],
            ],
        ],

        /* Other pages */
        'terms-and-conditions' => [
            'type' => 'Literal',
            'options' => [
                'route' => 'terms-and-conditions',
                'defaults' => [
                    'action' => 'termsAndConditions',
                ],
            ],
        ],
        'privacy-policy' => [
            'type' => 'Literal',
            'options' => [
                'route' => 'privacy-policy',
                'defaults' => [
                    'action' => 'privacyPolicy',
                ],
            ],
        ],
        'contact' => [
            'type' => 'Literal',
            'options' => [
                'route' => 'contact',
                'defaults' => [
                    'action' => 'contact',
                ],
            ],
        ],
    ],
];
