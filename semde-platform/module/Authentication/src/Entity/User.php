<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@inspireswgt.com>.
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
use Authentication\Entity\Role;

/**
 * 
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\Column(name="user")   
     */
    protected $user;

    /**
     * @ORM\Column(name="password")   
     */
    protected $password;

    /**
     * @ORM\Column(name="name")   
     */
    protected $name;

    /**
     * @ORM\Column(name="lastname")   
     */
    protected $lastname;

    /**
     * @ORM\Column(name="email")   
     */
    protected $email;

    /**
     * @ORM\Column(name="phone")   
     */
    protected $phone;

    /**
     * @ORM\ManyToMany(targetEntity="\Authentication\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="role_per_user",
     *      joinColumns={@ORM\JoinColumn(name="user", referencedColumnName="user")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role", referencedColumnName="role")}
     *      )
     */
    protected $roles;

    public function setRoles($newRoles)
    {
        $this->roles = $newRoles;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    // Removes association between this post and the given tag.
    public function removeRoleAssociation($role)
    {
        $this->roles->removeElement($role);
    }

    public function __construct()
    {
        //...  
        $this->roles = new ArrayCollection();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLastName()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPassword($newPassword)
    {
        $this->password = $newPassword;
    }

    public function setName($newName)
    {
        $this->name = $newName;
    }

    public function setLastName($newLastName)
    {
        $this->lastname = $newLastName;
    }

    public function setEmail($newEmail)
    {
        $this->email = $newEmail;
    }

    public function setPhone($newPhone)
    {
        $this->phone = $newPhone;
    }

}
