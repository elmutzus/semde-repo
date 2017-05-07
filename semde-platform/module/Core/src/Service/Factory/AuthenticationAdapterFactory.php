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

namespace Core\Service\Factory;

use Interop\Container\ContainerInterface;
use Core\Service\AuthenticationAdapter;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Description of AuthenticationAdapterFactory
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class AuthenticationAdapterFactory implements FactoryInterface
{ 
        /**
     * This method creates the AuthAdapter service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        // Get Doctrine entity manager from Service Manager.
        $entityManager = $container->get('doctrine.entitymanager.orm_authentication');        
                        
        // Create the AuthAdapter and inject dependency to its constructor.
        return new AuthenticationAdapter($entityManager);
    }
}
