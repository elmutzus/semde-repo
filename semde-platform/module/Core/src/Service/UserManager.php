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

    public function getAllUsers()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        $usersToReturn = array();

        foreach ($users as $user)
        {
            $usersToReturn[] = [
                'user'     => $user->getUser(),
                'name'     => $user->getName(),
                'lastname' => $user->getLastName(),
                'email'    => $user->getEmail(),
                'phone'    => $user->getPhone(),
            ];
        }

        return $usersToReturn;
    }

}
