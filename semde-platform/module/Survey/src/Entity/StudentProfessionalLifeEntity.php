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
 * @ORM\Table(name="professional_life")
 */
class StudentProfessionalLifeEntity
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
     * @ORM\Column(name="has_scholarship")   
     */
    protected $hasScholarship;

    /**
     * @ORM\Column(name="scholarship")   
     */
    protected $scholarship;

    /**
     * @ORM\Column(name="studies_languages")   
     */
    protected $studiesLanguages;

    /**
     * @ORM\Column(name="studies_languages_percentage")   
     */
    protected $studiesLanguagesPercentage;

    /**
     * @ORM\Column(name="studies_which_languages")   
     */
    protected $studiesWhichLanguages;

    /**
     * @ORM\Column(name="handles_languages")   
     */
    protected $handlesLanguages;

    /**
     * @ORM\Column(name="handles_languages_percentage")   
     */
    protected $handlesLanguagesPercentage;

    /**
     * @ORM\Column(name="handles_which_languages")   
     */
    protected $handlesWhichLanguages;

    /**
     * @ORM\Column(name="career_motivation")   
     */
    protected $careerMotivation;

    /**
     * @ORM\Column(name="hobbies")   
     */
    protected $hobbies;

    /**
     * @ORM\Column(name="self_description")   
     */
    protected $selfDescription;

    /**
     * @ORM\Column(name="career_id")   
     */
    protected $careerId;

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
    public function getHasScholarship()
    {
        return $this->hasScholarship;
    }

    /**
     * 
     * @return type
     */
    public function getScholarship()
    {
        return $this->scholarship;
    }

    /**
     * 
     * @return type
     */
    public function getStudiesLanguages()
    {
        return $this->studiesLanguages;
    }

    /**
     * 
     * @return type
     */
    public function getStudiesLanguagesPercentage()
    {
        return $this->studiesLanguagesPercentage;
    }

    /**
     * 
     * @return type
     */
    public function getStudiesWhichLanguages()
    {
        return $this->studiesWhichLanguages;
    }

    /**
     * 
     * @return type
     */
    public function getHandlesLanguages()
    {
        return $this->handlesLanguages;
    }

    /**
     * 
     * @return type
     */
    public function getHandlesLanguagesPercentage()
    {
        return $this->handlesLanguagesPercentage;
    }

    /**
     * 
     * @return type
     */
    public function getHandlesWhichLanguages()
    {
        return $this->handlesWhichLanguages;
    }

    /**
     * 
     * @return type
     */
    public function getCareerMotivation()
    {
        return $this->careerMotivation;
    }

    /**
     * 
     * @return type
     */
    public function getHobbies()
    {
        return $this->hobbies;
    }

    /**
     * 
     * @return type
     */
    public function getSelfDescription()
    {
        return $this->selfDescription;
    }

    /**
     * 
     * @return type
     */
    public function getCareerId()
    {
        return $this->careerId;
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
     * @param type $hasScholarship
     */
    public function setHasScholarship($hasScholarship)
    {
        $this->hasScholarship = $hasScholarship;
    }

    /**
     * 
     * @param type $scholarship
     */
    public function setScholarship($scholarship)
    {
        $this->scholarship = $scholarship;
    }

    /**
     * 
     * @param type $studiesLanguages
     */
    public function setStudiesLanguages($studiesLanguages)
    {
        $this->studiesLanguages = $studiesLanguages;
    }

    /**
     * 
     * @param type $studiesLanguagesPercentage
     */
    public function setStudiesLanguagesPercentage($studiesLanguagesPercentage)
    {
        $this->studiesLanguagesPercentage = $studiesLanguagesPercentage;
    }

    /**
     * 
     * @param type $studiesWhichLanguages
     */
    public function setStudiesWhichLanguages($studiesWhichLanguages)
    {
        $this->studiesWhichLanguages = $studiesWhichLanguages;
    }

    /**
     * 
     * @param type $handlesLanguages
     */
    public function setHandlesLanguages($handlesLanguages)
    {
        $this->handlesLanguages = $handlesLanguages;
    }

    /**
     * 
     * @param type $handlesLanguagesPercentage
     */
    public function setHandlesLanguagesPercentage($handlesLanguagesPercentage)
    {
        $this->handlesLanguagesPercentage = $handlesLanguagesPercentage;
    }

    /**
     * 
     * @param type $handlesWhichLanguages
     */
    public function setHandlesWhichLanguages($handlesWhichLanguages)
    {
        $this->handlesWhichLanguages = $handlesWhichLanguages;
    }

    /**
     * 
     * @param type $careerMotivation
     */
    public function setCareerMotivation($careerMotivation)
    {
        $this->careerMotivation = $careerMotivation;
    }

    /**
     * 
     * @param type $hobbies
     */
    public function setHobbies($hobbies)
    {
        $this->hobbies = $hobbies;
    }

    /**
     * 
     * @param type $selfDescription
     */
    public function setSelfDescription($selfDescription)
    {
        $this->selfDescription = $selfDescription;
    }

    /**
     * 
     * @param type $careerId
     */
    public function setCareerId($careerId)
    {
        $this->careerId = $careerId;
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
