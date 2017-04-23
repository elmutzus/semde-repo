<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elder.mutzus@inspireswgt.com> - initial API and implementation and/or initial documentation
 */

namespace Management;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router'             => [
        'routes' => [
            'userManagementRoute' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/management/user[/:action]',
                    'defaults' => [
                        'controller' => Controller\ManagementController::class,
                        'action'     => 'userManagement',
                    ],
                ],
            ],
        ],
    ],
    'controllers'        => [
        'factories' => [
            Controller\ManagementController::class => Controller\Factory\ManagementControllerFactory::class,
        ],
    ],
    'view_manager'       => [
        'template_path_stack' => [
            'Management' => __DIR__ . '/../view',
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
            Service\ManagementManager::class              => Service\Factory\ManagementManagerFactory::class,
        ],
    ],
    'view_manager'       => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'management/management/management' => __DIR__ . '/../view/management/management/management.phtml',
            'error/404'                           => __DIR__ . '/../view/error/404.phtml',
            'error/index'                         => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
    'session_containers' => [
        'SemdeSessionContainer'
    ],
];
