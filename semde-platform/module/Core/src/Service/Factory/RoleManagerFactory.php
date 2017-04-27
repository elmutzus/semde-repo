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

namespace Core\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Core\Service\RoleManager;

/**
 * Description of UserManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RoleManagerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        // Instantiate dependencies.
        $sessionContainer = $container->get('SemdeSessionContainer');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');

        // Instantiate the AuthManager service and inject dependencies to its constructor.
        return new RoleManager($sessionContainer, $entityManager);
    }
}