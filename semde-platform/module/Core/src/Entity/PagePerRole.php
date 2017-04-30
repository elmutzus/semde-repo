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

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @author Elder Mutzus <elmutzus@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="pages_per_role")
 */
class PagePerRole
{
    /**
     * @ORM\Id
     * @ORM\Column(name="role_id")   
     */
    protected $role;

    /**
     * @ORM\Id
     * @ORM\Column(name="page_id")   
     */
    protected $page;

    /**
     * @ORM\Column(name="description")   
     */
    protected $description;
    
    /*
     * Gets the role
     */

    public function getRole()
    {
        return $this->role;
    }

    /*
     * Gets the user
     */

    public function getPage()
    {
        return $this->page;
    }

    /*
     * Gets the description
     */

    public function getDescription()
    {
        return $this->description;
    }

    /*
     * Sets the role
     */

    public function setRole($role)
    {
        $this->role = $role;
    }

    /*
     * Sets the user
     */

    public function setPage($page)
    {
        $this->page = $page;
    }

    /*
     * Sets the description
     */

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
