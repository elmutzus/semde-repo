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
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 * @ORM\Entity
 * @ORM\Table(name="role")
 */
class Role
{

    /**
     * @ORM\Id
     * @ORM\Column(name="role")   
     */
    protected $role;

    /**
     * @ORM\Column(name="name")   
     */
    protected $name;

    /**
     * @ORM\Column(name="description")   
     */
    protected $description;

    /**
     * @ORM\ManyToMany(targetEntity="\Core\Entity\User", mappedBy="roles")
     */
    protected $users;

    /**
     * @ORM\ManyToMany(targetEntity="\Core\Entity\Page", inversedBy="roles")
     * @ORM\JoinTable(name="pages_per_role",
     *      joinColumns={@ORM\JoinColumn(name="role", referencedColumnName="role")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="page", referencedColumnName="page")}
     *      )
     */
    protected $pages;

    /*
     * Constructor
     */

    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->pages = new ArrayCollection();
    }

    /*
     * Sets the role
     */
    public function setRole($newRole)
    {
        $this->role = $newRole;
    }

    /*
     * Sets the name
     */
    public function setName($newName)
    {
        $this->name = $newName;
    }

    /*
     * Sets the description
     */
    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    /*
     * Gets the role
     */
    public function getRole()
    {
        return $this->role;
    }

    /*
     * Gets the name
     */
    public function getName()
    {
        return $this->name;
    }

    /*
     * Gets the description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /*
     * Gets the users
     */
    public function getUsers()
    {
        return $this->users;
    }

    /*
     * Adds a user
     */
    public function addUser($user)
    {
        $this->users[] = $user;
    }

    /*
     * Gets the pages
     */
    public function getPages()
    {
        return $this->pages;
    }

    /*
     * Adds a page
     */
    public function addPage($newPage)
    {
        $this->pages[] = $newPage;
    }

}
