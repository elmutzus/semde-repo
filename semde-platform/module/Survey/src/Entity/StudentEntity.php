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

namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @author Elder Mutzus <elmutzus@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="student")
 */
class StudentEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")   
     */
    protected $id;

    /**
     * @ORM\Column(name="dpi")   
     */
    protected $dpi;

    /**
     * @ORM\Column(name="nov")   
     */
    protected $nov;

    /**
     * @ORM\Column(name="nov")   
     */
    protected $nov;

    /**
     * @ORM\Column(name="name")   
     */
    protected $name;

    /**
     * @ORM\Column(name="lastname")   
     */
    protected $lastname;

    /**
     * @ORM\Column(name="gender")   
     */
    protected $gender;

    /**
     * @ORM\Column(name="birthdate")   
     */
    protected $birthdate;

    /*
     * Sets the ID
     */

    public function setId($id)
    {
        $this->id = $id;
    }

    /*
     * Sets the DPI
     */

    public function setDpi($dpi)
    {
        $this->dpi = $dpi;
    }

    /*
     * Sets the NOV
     */

    public function setNov($nov)
    {
        $this->nov = $nov;
    }

    /*
     * Sets the name
     */

    public function setName($name)
    {
        $this->name = $name;
    }

    /*
     * Sets the lastname
     */

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /*
     * Sets the gender
     */

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /*
     * Sets the birthdate
     */

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /*
     * Gets the ID
     */

    public function getId()
    {
        return $this->id;
    }

    /*
     * Gets the DPI
     */

    public function getDpi()
    {
        return $this->dpi;
    }

    /*
     * Gets the NOV
     */

    public function getNov()
    {
        return $this->nov;
    }

    /*
     * Gets the name
     */

    public function getName()
    {
        return $this->name;
    }

    /*
     * Gets the lastname
     */

    public function getLastname()
    {
        return $this->lastname;
    }

    /*
     * Gets the gender
     */

    public function getGender()
    {
        return $this->gender;
    }

    /*
     * Gets the birthdate
     */

    public function getBirthdate()
    {
        return $this->birthdate;
    }

}
