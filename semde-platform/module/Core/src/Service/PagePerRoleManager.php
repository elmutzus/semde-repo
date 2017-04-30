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

use Core\Entity\PagePerRole;

/**
 * Description of PagePerRoleManager
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class PagePerRoleManager
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
        $this->entityManager = $entityManager;
    }

    public function get($page, $role)
    {
        $item = $this->entityManager->getRepository(PagePerRole::class)->find([
            'page' => $page,
            'role' => $role,
        ]);

        return $item;
    }

    /*
     * Returns the list of all pages
     */

    public function getAll()
    {
        $items = $this->entityManager->getRepository(PagePerRole::class)->findAll();

        $itemsToReturn = array();

        foreach ($items as $item)
        {
            $itemsToReturn[] = [
                'page'        => $item->getPage(),
                'role'        => $item->getRole(),
                'description' => $item->getDescription(),
            ];
        }

        return $itemsToReturn;
    }

}
