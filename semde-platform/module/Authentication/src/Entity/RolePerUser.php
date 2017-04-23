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

/**
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 * 
 * @ORM\Entity
 * @ORM\Table(name="role_per_user")
 */
class RolePerUser
{
    //put your code here
    //role,user,description,active

    /**
     * @ORM\Id
     * @ORM\Column(name="role")   
     */
    protected $role;

    /**
     * @ORM\Column(name="user")   
     */
    protected $user;

    /**
     * @ORM\Column(name="description")   
     */
    protected $description;

    /**
     * @ORM\Column(name="active")   
     */
    protected $active;

    public function setRole($newRole)
    {
        $this->role = $newRole;
    }

    public function setUser($newUser)
    {
        $this->user = $newUser;
    }

    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }

    public function setActive($isActive)
    {
        $this->active = $isActive;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getActive()
    {
        return $this->active;
    }

}
