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
 * @ORM\Table(name="address")
 */
class StudentAddressEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(name="year")   
     */
    protected $year;

    /**
     * @ORM\Id
     * @ORM\Column(name="week")   
     */
    protected $week;

    /**
     * @ORM\Id
     * @ORM\Column(name="student_id")   
     */
    protected $studentId;

    /**
     * @ORM\Column(name="zone")   
     */
    protected $zone;

    /**
     * @ORM\Column(name="another_sector")   
     */
    protected $anotherSector;

    /**
     * @ORM\Column(name="updated")   
     */
    protected $updated;

    /**
     * @ORM\Column(name="town_id")   
     */
    protected $townId;

    /**
     * @ORM\Column(name="town_department_id")   
     */
    protected $departmentId;

    /**
     * 
     * @return type
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * 
     * @return type
     */
    public function getWeek()
    {
        return $this->week;
    }

    /**
     * 
     * @return type
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * 
     * @return type
     */
    public function getZone()
    {
        return $this->zone;
    }

    /**
     * 
     * @return type
     */
    public function getAnotherSector()
    {
        return $this->anotherSector;
    }

    /**
     * 
     * @return type
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * 
     * @return type
     */
    public function getTownId()
    {
        return $this->townId;
    }

    /**
     * 
     * @return type
     */
    public function getDepartmentId()
    {
        return $this->departmentId;
    }

    /**
     * 
     * @param type $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * 
     * @param type $week
     */
    public function setWeek($week)
    {
        $this->week = $week;
    }

    /**
     * 
     * @param type $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

    /**
     * 
     * @param type $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * 
     * @param type $anotherSector
     */
    public function setAnotherSector($anotherSector)
    {
        $this->anotherSector = $anotherSector;
    }

    /**
     * 
     * @param type $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * 
     * @param type $townId
     */
    public function setTownId($townId)
    {
        $this->townId = $townId;
    }

    /**
     * 
     * @param type $townDepartmentId
     */
    public function setDepartmentId($townDepartmentId)
    {
        $this->departmentId = $townDepartmentId;
    }

}
