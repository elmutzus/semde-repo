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

namespace Authentication\Entity;

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

    public function setRole($newRole)
    {
        $this->role = $newRole;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function __construct()
    {
        //...  
        $this->users = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="\Authentication\Entity\User", mappedBy="roles")
     */
    protected $users;

    public function getUsers()
    {
        return $this->users;
    }

    // Adds a post into collection of posts related to this tag.
    public function addUser($user)
    {
        $this->users[] = $user;
    }

}
