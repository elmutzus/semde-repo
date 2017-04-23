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

namespace Management\Service;


/**
 * Description of ManagementManager
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class ManagementManager
{

    /**
     * Session manager.
     * @var Zend\Session\SessionContainer
     */
    private $sessionContainer;

    /**
     * Contents of the 'access_filter' config key.
     * @var array 
     */
    private $config;
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($sessionContainer, $config, $entityManager)
    {
        $this->sessionContainer = $sessionContainer;
        $this->config           = $config;
        $this->entityManager    = $entityManager;
    }

    /**
     * Performs a login attempt. If $rememberMe argument is true, it forces the session
     * to last for one month (otherwise the session expires on one hour).
     */
    public function login($user, $password, $rememberMe)
    {
        
    }
}
