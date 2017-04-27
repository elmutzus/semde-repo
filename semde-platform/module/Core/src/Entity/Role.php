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
 * @ORM\Table(name="role")
 */
class Role
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
     * @ORM\ManyToMany(targetEntity="\Core\Entity\User", mappedBy="roles")
     */
    protected $users;

    /**
     * @ORM\ManyToMany(targetEntity="\Core\Entity\Page", inversedBy="roles")
     * @ORM\JoinTable(name="pages_per_role",
     *      joinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="page_id", referencedColumnName="id")}
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
    public function setId($newRole)
    {
        $this->id = $newRole;
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
    public function getId()
    {
        return $this->id;
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
