<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@gmail.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elmutzus@gmail.com> - initial API and implementation and/or initial documentation
 */

namespace Survey\Controller\Factory;

use Interop\Container\ContainerInterface;
use Survey\Controller\SurveyController;
use Survey\Service\SurveyManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of SurveyControllerFactory
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class SurveyControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $itemManager = $container->get(SurveyManager::class);
        $sessionContainer = $container->get('SemdeSessionContainer');
        
        return new SurveyController($itemManager, $sessionContainer);
    }
}