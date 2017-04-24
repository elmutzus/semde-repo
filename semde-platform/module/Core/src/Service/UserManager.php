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

namespace Core\Service;

use Core\Entity\User;

/**
 * Description of UserManager
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class UserManager
{
     /**
     * Authentication service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

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
    
    /*
     * Returns the list of all roles for the user
     */

    public function getAllRoles()
    {
        if (isset($this->sessionContainer->currentUserId))
        {
            $currentUserId = $this->sessionContainer->currentUserId;

            $user = $this->entityManager->getRepository(User::class)->findOneByUser($currentUserId);

            // If there is no such user, return 'Identity Not Found' status.
            if ($user == null)
            {
                throw new \Exception('El usuario no se encuentra para obtener el nombre');
            }

            $allRoles = array();

            foreach ($user->getRoles() as $role)
            {
                $allRoles[$role->getRole()] = $role->getName();
            }

            return $allRoles;
        }
        else
        {
            throw new \Exception('El usuario no ha iniciado sesión');
        }
    }
}
