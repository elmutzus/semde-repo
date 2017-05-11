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

    /**
     * @ORM\Column(name="moved_on")   
     */
    protected $movedOn;

    /**
     * @ORM\Column(name="moved_on_solution")   
     */
    protected $movedOnSolution;

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
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * 
     * @return type
     */
    public function getRepeatedSemesters()
    {
        return $this->repeatedSemesters;
    }

    /**
     * 
     * @return type
     */
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * 
     * @return type
     */
    public function getProfessing()
    {
        return $this->professing;
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
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * 
     * @return type
     */
    public function getHighschool()
    {
        return $this->highschool;
    }

    /**
     * 
     * @return type
     */
    public function getLivesWithOther()
    {
        return $this->livesWithOther;
    }

    /**
     * 
     * @return type
     */
    public function getOtherEconomicHelp()
    {
        return $this->otherEconomicHelp;
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
    public function getMaritalStatusId()
    {
        return $this->maritalStatusId;
    }

    /**
     * 
     * @return type
     */
    public function getLivingId()
    {
        return $this->livingId;
    }

    /**
     * 
     * @return type
     */
    public function getTravelTimeId()
    {
        return $this->travelTimeId;
    }

    /**
     * 
     * @return type
     */
    public function getTransportId()
    {
        return $this->transportId;
    }

    /**
     * 
     * @return type
     */
    public function getEconomicHelpId()
    {
        return $this->economicHelpId;
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
    public function getMovedOn()
    {
        return $this->movedOn;
    }

    /**
     * 
     * @return type
     */
    public function getMovedOnSolution()
    {
        return $this->movedOnSolution;
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
     * @param type $semester
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    /**
     * 
     * @param type $repeatedSemesters
     */
    public function setRepeatedSemesters($repeatedSemesters)
    {
        $this->repeatedSemesters = $repeatedSemesters;
    }

    /**
     * 
     * @param type $religion
     */
    public function setReligion($religion)
    {
        $this->religion = $religion;
    }

    /**
     * 
     * @param type $professing
     */
    public function setProfessing($professing)
    {
        $this->professing = $professing;
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
     * @param type $jobDescription
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }

    /**
     * 
     * @param type $highschool
     */
    public function setHighschool($highschool)
    {
        $this->highschool = $highschool;
    }

    /**
     * 
     * @param type $livesWithOther
     */
    public function setLivesWithOther($livesWithOther)
    {
        $this->livesWithOther = $livesWithOther;
    }

    /**
     * 
     * @param type $otherEconomicHelp
     */
    public function setOtherEconomicHelp($otherEconomicHelp)
    {
        $this->otherEconomicHelp = $otherEconomicHelp;
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
     * @param type $maritalStatusId
     */
    public function setMaritalStatusId($maritalStatusId)
    {
        $this->maritalStatusId = $maritalStatusId;
    }

    /**
     * 
     * @param type $livingId
     */
    public function setLivingId($livingId)
    {
        $this->livingId = $livingId;
    }

    /**
     * 
     * @param type $travelTimeId
     */
    public function setTravelTimeId($travelTimeId)
    {
        $this->travelTimeId = $travelTimeId;
    }

    /**
     * 
     * @param type $transportId
     */
    public function setTransportId($transportId)
    {
        $this->transportId = $transportId;
    }

    /**
     * 
     * @param type $economicHelpId
     */
    public function setEconomicHelpId($economicHelpId)
    {
        $this->economicHelpId = $economicHelpId;
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
     * @param type $movedOn
     */
    public function setMovedOn($movedOn)
    {
        $this->movedOn = $movedOn;
    }

    /**
     * 
     * @param type $movedOnSolution
     */
    public function setMovedOnSolution($movedOnSolution)
    {
        $this->movedOnSolution = $movedOnSolution;
    }

}
