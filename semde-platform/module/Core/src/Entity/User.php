<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@inspireswgt.com>.
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
 * @ORM\Table(name="user")
 */
class User
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")   
     */
    protected $id;

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
     * @ORM\ManyToMany(targetEntity="\Core\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(name="role_per_user",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     *      )
     */
    protected $roles;

    /*
     * Constructor
     */

    public function __construct()
    {
        //...  
        $this->roles = new ArrayCollection();
    }

    /*
     * Sets the roles
     */

    public function setRoles($newRoles)
    {
        $this->roles = $newRoles;
    }

    /*
     * Gets the roles
     */

    public function getRoles()
    {
        return $this->roles;
    }

    /*
     * Removes the role association
     */

    public function removeRoleAssociation($role)
    {
        $this->roles->removeElement($role);
    }

    /*
     * Gets User
     */

    public function getId()
    {
        return $this->id;
    }

    /*
     * Gets Password
     */

    public function getPassword()
    {
        return $this->password;
    }

    /*
     * Gets Name
     */

    public function getName()
    {
        return $this->name;
    }

    /*
     * Gets LastName
     */

    public function getLastName()
    {
        return $this->lastname;
    }

    /*
     * Gets Email
     */

    public function getEmail()
    {
        return $this->email;
    }

    /*
     * Gets Phone
     */

    public function getPhone()
    {
        return $this->phone;
    }

    /*
     * Sets the user
     */

    public function setId($newUser)
    {
        $this->id = $newUser;
    }

    /*
     * Sets Password
     */

    public function setPassword($newPassword)
    {
        $this->password = $newPassword;
    }

    /*
     *  Sets Name 
     */

    public function setName($newName)
    {
        $this->name = $newName;
    }

    /*
     * Sets last name
     */

    public function setLastName($newLastName)
    {
        $this->lastname = $newLastName;
    }

    /*
     * Sets email
     */

    public function setEmail($newEmail)
    {
        $this->email = $newEmail;
    }

    /*
     * Sets phone
     */

    public function setPhone($newPhone)
    {
        $this->phone = $newPhone;
    }

}
