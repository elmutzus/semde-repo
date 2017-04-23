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

namespace Management\Controller\Factory;

use Interop\Container\ContainerInterface;
use Management\Controller\ManagementController;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of ManagementControllerFactory
 *
 * @author manuel
 */
class ManagementControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {   
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $sessionContainer = $container->get('SemdeSessionContainer');
        
        return new ManagementController($entityManager, $sessionContainer);
    }
}
