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

use Core\Entity\RolePerUser;

/**
 * Description of RolePerUserManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RolePerUserManager
{
    /*
     * Entity manager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($entityManager)
    {
        $this->entityManager    = $entityManager;
    }
    
    public function get($role, $user)
    {
        $item = $this->entityManager->getRepository(RolePerUser::class)->find([
            'role' => $role,
            'user' => $user,
        ]);
        
        return $item;
    }
        
    /*
     * Returns the list of all pages
     */

    public function getAll()
    {
        $items = $this->entityManager->getRepository(RolePerUser::class)->findAll();

        $itemsToReturn = array();

        foreach ($items as $item)
        {
            $itemsToReturn[] = [
                'role'     => $item->getRole(),
                'user' => $item->getUser(),
                'description' => $item->getDescription(),
            ];
        }

        return $itemsToReturn;
    }
    
    public function create($entity)
    {
        $existingItem = $this->get($entity['role'], $entity['user']);

        if ($existingItem)
        {
            throw new \Exception('El rol ya se encuentra asignado al usuario');
        }

        $model = new RolePerUser();

        $model->setRole($entity['role']);
        $model->setUser($entity['user']);
        $model->setDescription($entity['description']);

        try
        {
            $this->entityManager->persist($model);
            $this->entityManager->flush();
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function delete($role, $user)
    {
        $existingItem = $this->get($role, $user);

        if ($existingItem)
        {
            try
            {
                $this->entityManager->remove($existingItem);
                $this->entityManager->flush();
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }
        else
        {
            throw new \Exception('La relación entre rol y usuario no se puede eliminar');
        }
    }
}
