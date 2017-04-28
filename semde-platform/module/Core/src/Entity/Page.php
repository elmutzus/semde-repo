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

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @author Elder Mutzus <elmutzus@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="page")
 */
class Page
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")   
     */
    protected $id;

    /**
     * @ORM\Column(name="description")   
     */
    protected $description;

    /**
     * @ORM\Column(name="route")   
     */
    protected $route;

    /**
     * @ORM\Column(name="type")   
     */
    protected $type;

    /**
     * @ORM\ManyToMany(targetEntity="\Core\Entity\Role", mappedBy="pages")
     */
    protected $roles;

    /*
     * Constructor
     */

    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }

    /*
     * Gest the page
     */

    public function getId()
    {
        return $this->id;
    }

    /*
     * Gest the description
     */

    public function getDescription()
    {
        return $this->description;
    }

    /*
     * Gets the route
     */

    public function getRoute()
    {
        return $this->route;
    }

    /*
     * Gets the type
     */

    public function getType()
    {
        return $this->type;
    }

    /*
     * Sets the Id
     */

    public function setId($id)
    {
        $this->id = $id;
    }

    /*
     * Sets the description
     */

    public function setDescription($description)
    {
        $this->description = $description;
    }

    /*
     * Sets the route
     */

    public function setRoute($route)
    {
        $this->route = $route;
    }

    /*
     * Sets the type
     */

    public function setType($type)
    {
        $this->type = $type;
    }

}
