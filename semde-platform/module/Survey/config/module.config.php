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

namespace Survey;

use Zend\Router\Http\Segment;
use Zend\Router\Http\Literal;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router'             => [
        'routes' => [
            'surveyManagementRoute' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/surveyManagement[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[a-zA-Z0-9_-]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\SurveyController::class,
                        'action'     => 'addOrUpdateStudent',
                    ],
                ],
            ],
            'surveyValidationRoute' => [
                'type'    => Literal::class,
                'options' => [
                    'route'       => '/surveyValidation',
                    'constraints' => [],
                    'defaults'    => [
                        'controller' => Controller\SurveyController::class,
                        'action'     => 'validateWeek',
                    ],
                ],
            ],
        ],
    ],
    'controllers'        => [
        'factories' => [
            Controller\SurveyController::class => Controller\Factory\SurveyControllerFactory::class,
        ],
    ],
    'view_manager'       => [
        'template_path_stack' => [
            'Survey' => __DIR__ . '/../view',
        ],
        'strategies'          => [
            'ViewJsonStrategy',
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
            Service\SurveyManager::class => Service\Factory\SurveyManagerFactory::class,
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
    'access_filter'      => [
        'options'     => [
            // The access filter can work in 'restrictive' (recommended) or 'permissive'
            // mode. In restrictive mode all controller actions must be explicitly listed 
            // under the 'access_filter' config key, and access is denied to any not listed 
            // action for not logged in users. In permissive mode, if an action is not listed 
            // under the 'access_filter' key, access to it is permitted to anyone (even for 
            // not logged in users. Restrictive mode is more secure and recommended to use.
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\SurveyController::class => [
                // Allow anyone to visit "index" and "about" actions
                ['actions' => [
                        'addOrUpdateStudent',
                        'addOrUpdateStudentAddress',
                        'addOrUpdateStudentStatus',
                        'addOrUpdateStudentProfessionalLife',
                        'addOrUpdateStudentFather',
                        'addOrUpdateStudentMother',
                        'addOrUpdateStudentBrother',
                        'addOrUpdateStudentMate',
                        'addOrUpdateStudentSocialLife',
                        'addOrUpdateStudentFinish',
                        'addOrUpdateStudentDepartments',
                        'validateWeek',
                    ],
                    'allow'   => '*'],
            ],
        ]
    ],
];
