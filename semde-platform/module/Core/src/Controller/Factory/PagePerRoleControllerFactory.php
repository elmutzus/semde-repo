<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elder.mutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elder.mutzus@inspireswgt.com> - initial API and implementation and/or initial documentation
 */

namespace Core\Controller\Factory;

use Interop\Container\ContainerInterface;
use Core\Controller\PagePerRoleController;
use Core\Service\RoleManager;
use Core\Service\PageManager;
use Core\Service\PagePerRoleManager;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of PagePerRoleControllerFactory
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class PagePerRoleControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $roleManager = $container->get(RoleManager::class);
        $pageManager = $container->get(PageManager::class);
        $itemManager = $container->get(PagePerRoleManager::class);
        $sessionContainer = $container->get('SemdeSessionContainer');
        
        return new PagePerRoleController($itemManager, $roleManager, $pageManager, $sessionContainer);
    }
}