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
 * @ORM\Table(name="mate")
 */
class StudentMateEntity
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
     * @ORM\Column(name="birthdate")   
     */
    protected $birthdate;

    /**
     * @ORM\Column(name="occupation")   
     */
    protected $occupation;

    /**
     * @ORM\Column(name="works")   
     */
    protected $works;

    /**
     * @ORM\Column(name="academic_title")   
     */
    protected $academicTitle;

    /**
     * @ORM\Column(name="time_together")   
     */
    protected $timeTogether;

    /**
     * @ORM\Column(name="communication")   
     */
    protected $communication;

    /**
     * @ORM\Column(name="gender")   
     */
    protected $gender;

    /**
     * @ORM\Column(name="active_sex_life")   
     */
    protected $activeSexLife;

    /**
     * @ORM\Column(name="updated")   
     */
    protected $updated;

    /**
     * @ORM\Column(name="relationship_id")   
     */
    protected $relationshipId;

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
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * 
     * @return type
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * 
     * @return type
     */
    public function getWorks()
    {
        return $this->works;
    }

    /**
     * 
     * @return type
     */
    public function getAcademicTitle()
    {
        return $this->academicTitle;
    }

    /**
     * 
     * @return type
     */
    public function getTimeTogether()
    {
        return $this->timeTogether;
    }

    /**
     * 
     * @return type
     */
    public function getCommunication()
    {
        return $this->communication;
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
    public function getActiveSexLife()
    {
        return $this->activeSexLife;
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
    public function getRelationshipId()
    {
        return $this->relationshipId;
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
     * @param type $birthdate
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * 
     * @param type $occupation
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;
    }

    /**
     * 
     * @param type $works
     */
    public function setWorks($works)
    {
        $this->works = $works;
    }

    /**
     * 
     * @param type $academicTitle
     */
    public function setAcademicTitle($academicTitle)
    {
        $this->academicTitle = $academicTitle;
    }

    /**
     * 
     * @param type $timeTogether
     */
    public function setTimeTogether($timeTogether)
    {
        $this->timeTogether = $timeTogether;
    }

    /**
     * 
     * @param type $communication
     */
    public function setCommunication($communication)
    {
        $this->communication = $communication;
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
     * @param type $activeSexLife
     */
    public function setActiveSexLife($activeSexLife)
    {
        $this->activeSexLife = $activeSexLife;
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
     * @param type $relationshipId
     */
    public function setRelationshipId($relationshipId)
    {
        $this->relationshipId = $relationshipId;
    }

}
