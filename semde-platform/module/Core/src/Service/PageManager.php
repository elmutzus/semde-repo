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

use Core\Entity\Page;

/**
 * Description of PageManagement
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class PageManager
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
     * Returns the list of all pages
     */

    public function getAll()
    {
        $items = $this->entityManager->getRepository(Page::class)->findAll();

        $itemsToReturn = array();

        foreach ($items as $item)
        {
            $itemsToReturn[] = [
                'id'     => $item->getId(),
                'description' => $item->getDescription(),
                'route' => $item->getRoute(),
                'type' => ($item->getType() == 'M' ? 'Gestión' : 'Reporte'),
            ];
        }

        return $itemsToReturn;
    }

    public function get($id)
    {
        $item = $this->entityManager->getRepository(Page::class)->findById($id);
        
        if(sizeof($item) == 1)
            return $item[0];

        return null;
    }
    
    public function create($entity)
    {
        $existingItem = $this->get($entity['id']);

        if ($existingItem)
        {
            throw new \Exception('El nombre de la página no está disponible');
        }

        $model = new Page();

        $model->setId($entity['id']);
        $model->setDescription($entity['description']);
        $model->setRoute($entity['route']);
        $model->setType($entity['type']);

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
        $updatedItem = new Page();
        $updatedItem->setId($entity['id']);
        $updatedItem->setDescription($entity['description']);
        $updatedItem->setRoute($entity['route']);
        $updatedItem->setType($entity['type']);

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
            throw new \Exception('La página no se puede eliminar');
        }
    }
}
