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
}
