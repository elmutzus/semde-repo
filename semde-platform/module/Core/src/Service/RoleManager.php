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

/**
 * Description of UserManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RoleManager
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
                'id'     => $item->getId(),
                'description' => $item->getDescription()
            ];
        }

        return $itemsToReturn;
    }

    public function get($id)
    {
        $item = $this->entityManager->getRepository(Role::class)->findById($id);
        
        if(sizeof($item) == 1)
            return $item[0];

        return null;
    }
  
    public function create($entity)
    {
        $existingItem = $this->get($entity['id']);

        if ($existingItem)
        {
            throw new \Exception('El nombre del rol no está disponible');
        }

        $model = new Role();

        $model->setId($entity['id']);
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

    public function update($entity)
    {
        $updatedItem = new Role();
        $updatedItem->setId($entity['id']);
        $updatedItem->setDescription($entity['description']);

        try
        {
            $this->entityManager->merge($updatedItem);
            $this->entityManager->flush();
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }

    public function delete($id)
    {
        $existingItem = $this->get($id);

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
            throw new \Exception('El rol no se puede eliminar');
        }
    }

}
