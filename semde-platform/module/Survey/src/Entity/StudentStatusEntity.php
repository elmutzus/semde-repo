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
 * @ORM\Table(name="student_status")
 */
class StudentStatusEntity
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
     * @ORM\Column(name="semester")   
     */
    protected $semester;

    /**
     * @ORM\Column(name="repeated_semesters")   
     */
    protected $repeatedSemesters;

    /**
     * @ORM\Column(name="religion")   
     */
    protected $religion;

    /**
     * @ORM\Column(name="professing")   
     */
    protected $professing;

    /**
     * @ORM\Column(name="works")   
     */
    protected $works;

    /**
     * @ORM\Column(name="job_description")   
     */
    protected $jobDescription;

    /**
     * @ORM\Column(name="highschool")   
     */
    protected $highschool;

    /**
     * @ORM\Column(name="lives_with_other")   
     */
    protected $livesWithOther;

    /**
     * @ORM\Column(name="other_economic_help")   
     */
    protected $otherEconomicHelp;

    /**
     * @ORM\Column(name="updated")   
     */
    protected $updated;

    /**
     * @ORM\Column(name="marital_status_id")   
     */
    protected $maritalStatusId;

    /**
     * @ORM\Column(name="living_id")   
     */
    protected $livingId;

    /**
     * @ORM\Column(name="travel_time_id")   
     */
    protected $travelTimeId;

    /**
     * @ORM\Column(name="transport_id")   
     */
    protected $transportId;

    /**
     * @ORM\Column(name="economic_help_id")   
     */
    protected $economicHelpId;

    

    public function getId()
    {
        return $this->id;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getWeek()
    {
        return $this->week;
    }

    public function getSemester()
    {
        return $this->semester;
    }

    public function getRepeatedSemesters()
    {
        return $this->repeatedSemesters;
    }

    public function getReligion()
    {
        return $this->religion;
    }

    public function getProfessing()
    {
        return $this->professing;
    }

    public function getWorks()
    {
        return $this->works;
    }

    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    public function getHighschool()
    {
        return $this->highschool;
    }

    public function getLivesWithOther()
    {
        return $this->livesWithOther;
    }

    public function getOtherEconomicHelp()
    {
        return $this->otherEconomicHelp;
    }

    public function getUpdated()
    {
        return $this->updated;
    }

    public function getMaritalStatusId()
    {
        return $this->maritalStatusId;
    }

    public function getLivingId()
    {
        return $this->livingId;
    }

    public function getTravelTimeId()
    {
        return $this->travelTimeId;
    }

    public function getTransportId()
    {
        return $this->transportId;
    }

    public function getEconomicHelpId()
    {
        return $this->economicHelpId;
    }

    public function getStudentId()
    {
        return $this->studentId;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function setWeek($week)
    {
        $this->week = $week;
    }

    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    public function setRepeatedSemesters($repeatedSemesters)
    {
        $this->repeatedSemesters = $repeatedSemesters;
    }

    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    public function setProfessing($professing)
    {
        $this->professing = $professing;
    }

    public function setWorks($works)
    {
        $this->works = $works;
    }

    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }

    public function setHighschool($highschool)
    {
        $this->highschool = $highschool;
    }

    public function setLivesWithOther($livesWithOther)
    {
        $this->livesWithOther = $livesWithOther;
    }

    public function setOtherEconomicHelp($otherEconomicHelp)
    {
        $this->otherEconomicHelp = $otherEconomicHelp;
    }

    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    public function setMaritalStatusId($maritalStatusId)
    {
        $this->maritalStatusId = $maritalStatusId;
    }

    public function setLivingId($livingId)
    {
        $this->livingId = $livingId;
    }

    public function setTravelTimeId($travelTimeId)
    {
        $this->travelTimeId = $travelTimeId;
    }

    public function setTransportId($transportId)
    {
        $this->transportId = $transportId;
    }

    public function setEconomicHelpId($economicHelpId)
    {
        $this->economicHelpId = $economicHelpId;
    }

    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }

}
