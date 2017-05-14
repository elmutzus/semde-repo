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
 * @ORM\Table(name="brother")
 */
class StudentBrotherEntity
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
     * @ORM\Column(name="quantity")   
     */
    protected $quantity;

    /**
     * @ORM\Column(name="place")   
     */
    protected $place;

    /**
     * @ORM\Column(name="academic_title")   
     */
    protected $academicTitle;

    /**
     * @ORM\Column(name="communication")   
     */
    protected $communication;

    /**
     * @ORM\Column(name="has_chronic_disease")   
     */
    protected $hasChronicDisease;

    /**
     * @ORM\Column(name="chronic_disease")   
     */
    protected $chronicDisease;

    /**
     * @ORM\Column(name="has_learning_illness")   
     */
    protected $hasLearningIllness;

    /**
     * @ORM\Column(name="learning_illness")   
     */
    protected $learningIllness;

    /**
     * @ORM\Column(name="updated")   
     */
    protected $updated;

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
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * 
     * @return type
     */
    public function getPlace()
    {
        return $this->place;
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
    public function getCommunication()
    {
        return $this->communication;
    }

    /**
     * 
     * @return type
     */
    public function getHasChronicDisease()
    {
        return $this->hasChronicDisease;
    }

    /**
     * 
     * @return type
     */
    public function getChronicDisease()
    {
        return $this->chronicDisease;
    }

    /**
     * 
     * @return type
     */
    public function getHasLearningIllness()
    {
        return $this->hasLearningIllness;
    }

    /**
     * 
     * @return type
     */
    public function getLearningIllness()
    {
        return $this->learningIllness;
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
     * @param type $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * 
     * @param type $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
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
     * @param type $communication
     */
    public function setCommunication($communication)
    {
        $this->communication = $communication;
    }

    /**
     * 
     * @param type $hasChronicDisease
     */
    public function setHasChronicDisease($hasChronicDisease)
    {
        $this->hasChronicDisease = $hasChronicDisease;
    }

    /**
     * 
     * @param type $chronicDisease
     */
    public function setChronicDisease($chronicDisease)
    {
        $this->chronicDisease = $chronicDisease;
    }

    /**
     * 
     * @param type $hasLearningIllness
     */
    public function setHasLearningIllness($hasLearningIllness)
    {
        $this->hasLearningIllness = $hasLearningIllness;
    }

    /**
     * 
     * @param type $learningIllness
     */
    public function setLearningIllness($learningIllness)
    {
        $this->learningIllness = $learningIllness;
    }

    /**
     * 
     * @param type $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

}
