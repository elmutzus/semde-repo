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

namespace Authentication\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Authentication\Service\AuthenticationManager;

/**
 * Description of AuthenticationManagerFactory
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class AuthenticationManagerFactory implements FactoryInterface
{
    /**
     * This method creates the AuthManager service and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {        
        // Instantiate dependencies.
        $authenticationService = $container->get(\Zend\Authentication\AuthenticationService::class);
        $sessionContainer = $container->get('SemdeSessionContainer');
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        
        // Get contents of 'access_filter' config key (the AuthManager service
        // will use this data to determine whether to allow currently logged in user
        // to execute the controller action or not.
        $config = $container->get('Config');
        if (isset($config['access_filter']))
            $config = $config['access_filter'];
        else
            $config = [];
                        
        // Instantiate the AuthManager service and inject dependencies to its constructor.
        return new AuthenticationManager($authenticationService, $sessionContainer, $config, $entityManager);
    }
}
