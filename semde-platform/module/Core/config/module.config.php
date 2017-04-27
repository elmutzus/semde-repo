<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elmutzus@gmail.com> - initial API and implementation and/or initial documentation
 */

namespace Core;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router'             => [
        'routes' => [
            'loginRoute'          => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'homeRoute'           => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'roleSelectionRoute'  => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/roleSelection',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'roleSelection',
                    ],
                ],
            ],
            'logoutRoute'         => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'mainDashboardRoute'  => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/mainDashboard',
                    'defaults' => [
                        'controller' => Controller\AuthenticationController::class,
                        'action'     => 'mainDashboard',
                    ],
                ],
            ],
            'userManagementRoute' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/userManagement[/:action[/:user]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'user'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\UserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'roleManagementRoute' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/roleManagement[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\RoleController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers'        => [
        'factories' => [
            Controller\AuthenticationController::class => Controller\Factory\AuthenticationControllerFactory::class,
            Controller\UserController::class           => Controller\Factory\UserControllerFactory::class,
            Controller\RoleController::class           => Controller\Factory\RoleControllerFactory::class,
        ],
    ],
    'view_manager'       => [
        'template_path_stack' => [
            'Authentication' => __DIR__ . '/../view',
        ],
    ],
    'doctrine'           => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default'             => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    'service_manager'    => [
        'factories' => [
            Service\AuthenticationAdapter::class              => Service\Factory\AuthenticationAdapterFactory::class,
            Service\AuthenticationManager::class              => Service\Factory\AuthenticationManagerFactory::class,
            \Zend\Authentication\AuthenticationService::class => Service\Factory\AuthenticationServiceFactory::class,
            Service\UserManager::class                        => Service\Factory\UserManagerFactory::class,
            Service\RoleManager::class                        => Service\Factory\RoleManagerFactory::class,
        ],
    ],
    'view_manager'       => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout'   => __DIR__ . '/../view/layout/unauthenticated.phtml',
            'core/core/login' => __DIR__ . '/../view/core/core/login.phtml',
            'error/404'       => __DIR__ . '/../view/error/404.phtml',
            'error/index'     => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
    'session_containers' => [
        'SemdeSessionContainer'
    ],
];
