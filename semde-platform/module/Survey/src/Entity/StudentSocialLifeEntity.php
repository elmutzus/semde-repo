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
 * @ORM\Table(name="social_life")
 */
class StudentSocialLifeEntity
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
     * @ORM\Column(name="social_life_other")   
     */
    protected $socialLifeOther;

    /**
     * @ORM\Column(name="exercises")   
     */
    protected $exercises;

    /**
     * @ORM\Column(name="exercises_which")   
     */
    protected $exercisesWhich;

    /**
     * @ORM\Column(name="exercises_frequency")   
     */
    protected $exercisesFrequency;

    /**
     * @ORM\Column(name="drinks_alcohol")   
     */
    protected $drinksAlcohol;

    /**
     * @ORM\Column(name="drinks_alcohol_frequency")   
     */
    protected $drinksAlcoholFrequency;

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
     * @ORM\Column(name="study_time")   
     */
    protected $studyTime;

    /**
     * @ORM\Column(name="study_methodology")   
     */
    protected $studyMethodology;

    /**
     * @ORM\Column(name="sleep_hours")   
     */
    protected $sleepHours;

    /**
     * @ORM\Column(name="family_hours")   
     */
    protected $familyHours;

    /**
     * @ORM\Column(name="friends_hours")   
     */
    protected $friendsHours;

    /**
     * @ORM\Column(name="mate_hours")   
     */
    protected $mateHours;

    /**
     * @ORM\Column(name="another_activity_time")   
     */
    protected $anotherActivityTime;

    /**
     * @ORM\Column(name="family_communication")   
     */
    protected $familyCommunication;

    /**
     * @ORM\Column(name="updated")   
     */
    protected $updated;

    /**
     * @ORM\Column(name="social_life_type_id")   
     */
    protected $socialLifeTypeId;

    /**
     * @ORM\Column(name="smokes")   
     */
    protected $smokes;

    /**
     * @ORM\Column(name="smokes_frequency")   
     */
    protected $smokesFrequency;

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
    public function getSocialLifeOther()
    {
        return $this->socialLifeOther;
    }

    /**
     * 
     * @return type
     */
    public function getExercises()
    {
        return $this->exercises;
    }

    /**
     * 
     * @return type
     */
    public function getExercisesWhich()
    {
        return $this->exercisesWhich;
    }

    /**
     * 
     * @return type
     */
    public function getExercisesFrequency()
    {
        return $this->exercisesFrequency;
    }

    /**
     * 
     * @return type
     */
    public function getDrinksAlcohol()
    {
        return $this->drinksAlcohol;
    }

    /**
     * 
     * @return type
     */
    public function getDrinksAlcoholFrequency()
    {
        return $this->drinksAlcoholFrequency;
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
    public function getStudyTime()
    {
        return $this->studyTime;
    }

    /**
     * 
     * @return type
     */
    public function getStudyMethodology()
    {
        return $this->studyMethodology;
    }

    /**
     * 
     * @return type
     */
    public function getSleepHours()
    {
        return $this->sleepHours;
    }

    /**
     * 
     * @return type
     */
    public function getFamilyHours()
    {
        return $this->familyHours;
    }

    /**
     * 
     * @return type
     */
    public function getFriendsHours()
    {
        return $this->friendsHours;
    }

    /**
     * 
     * @return type
     */
    public function getMateHours()
    {
        return $this->mateHours;
    }

    /**
     * 
     * @return type
     */
    public function getAnotherActivityTime()
    {
        return $this->anotherActivityTime;
    }

    /**
     * 
     * @return type
     */
    public function getFamilyCommunication()
    {
        return $this->familyCommunication;
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
    public function getSocialLifeTypeId()
    {
        return $this->socialLifeTypeId;
    }

    /**
     * 
     * @return type
     */
    public function getSmokes()
    {
        return $this->smokes;
    }

    /**
     * 
     * @return type
     */
    public function getSmokesFrequency()
    {
        return $this->smokesFrequency;
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
     * @param type $socialLifeOther
     */
    public function setSocialLifeOther($socialLifeOther)
    {
        $this->socialLifeOther = $socialLifeOther;
    }

    /**
     * 
     * @param type $exercises
     */
    public function setExercises($exercises)
    {
        $this->exercises = $exercises;
    }

    /**
     * 
     * @param type $exercisesWhich
     */
    public function setExercisesWhich($exercisesWhich)
    {
        $this->exercisesWhich = $exercisesWhich;
    }

    /**
     * 
     * @param type $exercisesFrequency
     */
    public function setExercisesFrequency($exercisesFrequency)
    {
        $this->exercisesFrequency = $exercisesFrequency;
    }

    /**
     * 
     * @param type $drinksAlcohol
     */
    public function setDrinksAlcohol($drinksAlcohol)
    {
        $this->drinksAlcohol = $drinksAlcohol;
    }

    /**
     * 
     * @param type $drinksAlcoholFrequency
     */
    public function setDrinksAlcoholFrequency($drinksAlcoholFrequency)
    {
        $this->drinksAlcoholFrequency = $drinksAlcoholFrequency;
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
     * @param type $studyTime
     */
    public function setStudyTime($studyTime)
    {
        $this->studyTime = $studyTime;
    }

    /**
     * 
     * @param type $studyMethodology
     */
    public function setStudyMethodology($studyMethodology)
    {
        $this->studyMethodology = $studyMethodology;
    }

    /**
     * 
     * @param type $sleepHours
     */
    public function setSleepHours($sleepHours)
    {
        $this->sleepHours = $sleepHours;
    }

    /**
     * 
     * @param type $familyHours
     */
    public function setFamilyHours($familyHours)
    {
        $this->familyHours = $familyHours;
    }

    /**
     * 
     * @param type $friendsHours
     */
    public function setFriendsHours($friendsHours)
    {
        $this->friendsHours = $friendsHours;
    }

    /**
     * 
     * @param type $mateHours
     */
    public function setMateHours($mateHours)
    {
        $this->mateHours = $mateHours;
    }

    /**
     * 
     * @param type $anotherActivityTime
     */
    public function setAnotherActivityTime($anotherActivityTime)
    {
        $this->anotherActivityTime = $anotherActivityTime;
    }

    /**
     * 
     * @param type $familyCommunication
     */
    public function setFamilyCommunication($familyCommunication)
    {
        $this->familyCommunication = $familyCommunication;
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
     * @param type $socialLifeTypeId
     */
    public function setSocialLifeTypeId($socialLifeTypeId)
    {
        $this->socialLifeTypeId = $socialLifeTypeId;
    }

    /**
     * 
     * @param type $smokes
     */
    public function setSmokes($smokes)
    {
        $this->smokes = $smokes;
    }

    /**
     * 
     * @param type $smokesFrequency
     */
    public function setSmokesFrequency($smokesFrequency)
    {
        $this->smokesFrequency = $smokesFrequency;
    }

}
