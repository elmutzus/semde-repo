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

namespace Core\Service;

use Zend\Authentication\Result;
use Core\Entity\User;
use Core\Entity\Role;

/**
 * Description of AuthenticationManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class AuthenticationManager
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
    public function __construct($authService, $sessionContainer, $config, $entityManager)
    {
        $this->authService      = $authService;
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
        if ($this->authService->getIdentity() != null)
        {
            $this->authService->clearIdentity();
        }

        // Authenticate with login/password.
        $authAdapter = $this->authService->getAdapter();
        $authAdapter->setId($user);
        $authAdapter->setPassword($password);
        $result      = $this->authService->authenticate();

        // If user wants to "remember him", we will make session to expire in 
        // one month. By default session expires in 1 hour (as specified in our 
        // config/global.php file).
        if ($result->getCode() == Result::SUCCESS && $rememberMe)
        {
            // Session cookie will expire in 1 month (30 days).
            $this->sessionContainer->rememberMe(60 * 60 * 24 * 30);
        }

        return $result;
    }

    /*
     * Returns the list of all roles for the user
     */

    public function getAllRoles()
    {
        if (isset($this->sessionContainer->currentUserId))
        {
            $currentUserId = $this->sessionContainer->currentUserId;

            $user = $this->entityManager->getRepository(User::class)->findOneById($currentUserId);

            // If there is no such user, return 'Identity Not Found' status.
            if ($user == null)
            {
                throw new \Exception('El usuario no se encuentra para obtener el nombre');
            }

            $allRoles = array();

            foreach ($user->getRoles() as $role)
            {
                $allRoles[$role->getId()] = $role->getDescription();
            }

            return $allRoles;
        }
        else
        {
            throw new \Exception('El usuario no ha iniciado sesión');
        }
    }

    public function getRoleDescription($roleName)
    {
        $role = $this->entityManager->getRepository(Role::class)->findOneById($roleName);

        // If there is no such user, return 'Identity Not Found' status.
        if ($role == null)
        {
            throw new \Exception('El usuario no se encuentra para obtener el nombre');
        }

        return $role->getDescription();
    }

    /*
     *  Returns the full name of the user: LastName, FirstName
     */

    public function getUserFullName()
    {
        if (isset($this->sessionContainer->currentUserId))
        {
            $currentUserId = $this->sessionContainer->currentUserId;

            $user = $this->entityManager->getRepository(User::class)->findOneById($currentUserId);

            // If there is no such user, return 'Identity Not Found' status.
            if ($user == null)
            {
                throw new \Exception('El usuario no se encuentra para obtener el nombre');
            }

            return $user->getLastName() . ', ' . $user->getName();
        }
        else
        {
            throw new \Exception('El usuario no ha iniciado sesión');
        }
    }

    public function getPagesForCurrentRole()
    {
        if (isset($this->sessionContainer->currentUserRoleId))
        {
            $currentRoleId = $this->sessionContainer->currentUserRoleId;

            $role = $this->entityManager->getRepository(Role::class)->findOneById($currentRoleId);

            if ($role)
            {
                return $role->getPages();
            }
        }
        else
        {
            throw new \Exception('El usuario no ha iniciado sesión');
        }
    }

    /**
     * Performs user logout.
     */
    public function logout()
    {
        // Allow to log out only when user is logged in.
        if ($this->authService->getIdentity() == null)
        {
            throw new \Exception('The user is not logged in');
        }

        // Remove identity from session.
        $this->authService->clearIdentity();
    }

    /**
     * This is a simple access control filter. It is able to restrict unauthorized
     * users to visit certain pages.
     * 
     * This method uses the 'access_filter' key in the config file and determines
     * whenther the current visitor is allowed to access the given controller action
     * or not. It returns true if allowed; otherwise false.
     */
    public function filterAccess($controllerName, $actionName)
    {
        // Determine mode - 'restrictive' (default) or 'permissive'. In restrictive
        // mode all controller actions must be explicitly listed under the 'access_filter'
        // config key, and access is denied to any not listed action for unauthorized users. 
        // In permissive mode, if an action is not listed under the 'access_filter' key, 
        // access to it is permitted to anyone (even for not logged in users.
        // Restrictive mode is more secure and recommended to use.
        $mode = isset($this->config['options']['mode']) ? $this->config['options']['mode'] : 'restrictive';
        if ($mode != 'restrictive' && $mode != 'permissive')
            throw new \Exception('Invalid access filter mode (expected either restrictive or permissive mode');

        if (isset($this->config['controllers'][$controllerName]))
        {
            $items = $this->config['controllers'][$controllerName];
            foreach ($items as $item)
            {
                $actionList = $item['actions'];
                $allow      = $item['allow'];
                if (is_array($actionList) && in_array($actionName, $actionList) ||
                        $actionList == '*')
                {
                    if ($allow == '*')
                        return true; // Anyone is allowed to see the page.
                    else if ($allow == '@' && $this->authService->hasIdentity())
                    {
                        return true; // Only authenticated user is allowed to see the page.
                    }
                    else
                    {
                        return false; // Access denied.
                    }
                }
            }
        }

        // In restrictive mode, we forbid access for unauthorized users to any 
        // action not listed under 'access_filter' key (for security reasons).
        if ($mode == 'restrictive' && !$this->authService->hasIdentity())
            return false;

        // Permit access to this page.
        return true;
    }

}
