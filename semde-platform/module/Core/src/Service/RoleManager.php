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

namespace Core\Service;

use Core\Entity\Role;
use Zend\Crypt\Password\Bcrypt;

/**
 * Description of UserManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RoleManager
{

    /**
     * Session manager.
     * @var Zend\Session\SessionContainer
     */
    private $sessionContainer;

    /*
     * Entity manager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($sessionContainer, $entityManager)
    {
        $this->sessionContainer = $sessionContainer;
        $this->entityManager    = $entityManager;
    }

    /*
     * Returns the list of all roles
     */

    public function getAll()
    {
        $items = $this->entityManager->getRepository(Role::class)->findAll();

        $itemsToReturn = array();

        foreach ($items as $item)
        {
            $itemsToReturn[] = [
                'role'     => $item->getRole(),
                'name'     => $item->getName(),
                'description' => $item->getDescription()
            ];
        }

        return $itemsToReturn;
    }

    public function get($id)
    {
        
    }

    public function create($entity)
    {
        
    }

    public function update($entity)
    {
        
    }

    public function delete($id)
    {

    }

}
