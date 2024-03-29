<?php


namespace Pessoa;

use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;


return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\PessoaController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'pessoa' => [
                'type' => \Zend\Router\Http\Segment::class,
                'options' => [
                    'route' => '/pessoa[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-z][a-zA-z0-9_-]*',
                        'id' => '[0-9]+'
                    ],
                    'defaults' => [
                        'controller' => Controller\PessoaController::class,
                        'action' => 'index'
                    ]
                ]
            ]
        ]
    ],
    'controllers' =>[
        'factories' => [
            // Controller\PessoaController::class => InvokableFactory::class
        ]
    ],
    'view_manager' => [
        'display_exceptions'       => true,
        'template_path_stack' => [
            'pessoa' => __DIR__ . "/../view",
        ]
    ],
    'db' => [
        'driver' => 'Pdo_mysql',
        'database' => 'teste',
        'username' => 'caio',
        'password' => '123456',
        'hostname' => 'localhost',
    ]
];



