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

    /**
     * @ORM\Column(name="birthplace")   
     */
    protected $birthplace;

    /**
     * 
     * @param type $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * 
     * @param type $dpi
     */
    public function setDpi($dpi)
    {
        $this->dpi = $dpi;
    }

    /**
     * 
     * @param type $nov
     */
    public function setNov($nov)
    {
        $this->nov = $nov;
    }

    /**
     * 
     * @param type $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * 
     * @param type $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * 
     * @param type $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * 
     * @param type $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }
    
    /**
     * 
     * @param type $birthplace
     */
    public function setBirthplace($birthplace){
        $this->birthplace = $birthplace;
    }

    /**
     * 
     * @return type
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 
     * @return type
     */
    public function getDpi()
    {
        return $this->dpi;
    }

    /**
     * 
     * @return type
     */
    public function getNov()
    {
        return $this->nov;
    }

    /**
     * 
     * @return type
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @return type
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * 
     * @return type
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * 
     * @return type
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    
    /**
     * 
     * @return type
     */
    public function getBirthplace(){
        return $this->birthplace;
    }

}
