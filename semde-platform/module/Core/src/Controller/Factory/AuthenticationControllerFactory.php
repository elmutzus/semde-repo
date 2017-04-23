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

namespace Core\Controller\Factory;

use Interop\Container\ContainerInterface;
use Core\Controller\AuthenticationController;
use Zend\ServiceManager\Factory\FactoryInterface;
use Core\Service\AuthenticationManager;

/**
 * Description of AuthenticationControllerFactory
 *
 * @author manuel
 */
class AuthenticationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $authManager = $container->get(AuthenticationManager::class);
        $authService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $sessionContainer = $container->get('SemdeSessionContainer');
        
        return new AuthenticationController($entityManager, $authManager, $authService, $sessionContainer);
    }
}
