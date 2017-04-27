<?php

/* 
 * Copyright (c) 2017 Elder Mutzus <elder.mutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elmutzus@gmail.com> - initial API and implementation and/or initial documentation
 */

namespace Core\Controller\Factory;

use Interop\Container\ContainerInterface;
use Core\Controller\RoleController;
use Core\Service\RoleManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of UserControllerFactory
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RoleControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $userManager = $container->get(RoleManager::class);
        $sessionContainer = $container->get('SemdeSessionContainer');
        
        return new RoleController($userManager, $sessionContainer);
    }
}