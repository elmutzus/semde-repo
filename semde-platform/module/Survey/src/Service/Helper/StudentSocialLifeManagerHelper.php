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

namespace Survey\Service\Helper;

use \DateTime;
use Survey\Entity\StudentSocialLifeEntity;

/**
 * Description of StudentSocialLifeManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentSocialLifeManagerHelper
{
    /**
     *
     * @var type 
     */
    private $entityManager;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * 
     * @param type $id
     */
    public function getStudentSocialLifeById($id)
    {
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentSocialLifeEntity::class)->findBy(
                ['year' => $now->format('Y'), 'studentId' => $id,], ['week' => 'DESC',]
        );

        if (sizeof($items) >= 1)
        {
            return $items[0];
        }

        return null;
    }
    
    /**
     * 
     * @param type $studentId
     * @param type $year
     * @param type $week
     * @param type $parentType
     * @return boolean
     */
    public function existsSpecificSocialLife($studentId, $year, $week)
    {
        $item = $this->entityManager->getRepository(StudentSocialLifeEntity::class)->find([
            'year'      => $year,
            'week'      => $week,
            'studentId' => $studentId,
        ]);

        if ($item)
        {
            return true;
        }

        return false;
    }
    
    /**
     * 
     * @param type $entity
     */
    public function addOrUpdateStudentSocialLife($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentSocialLifeEntity();

        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));
        $model->setStudentId($entity['studentId']);

        $model->setSocialLifeOther($entity['socialLifeOther']);
        $model->setExercises($entity['exercises']);
        $model->setExercisesWhich($entity['exercisesWhich']);
        $model->setExercisesFrequency($entity['exercisesFrequency']);
        $model->setDrinksAlcohol($entity['drinksAlcohol']);
        $model->setDrinksAlcoholFrequency($entity['drinksAlcoholFrequency']);
        $model->setSmokes($entity['smokes']);
        $model->setSmokesFrequency($entity['smokesFrequency']);
        $model->setHasChronicDisease($entity['hasChronicDisease']);
        $model->setChronicDisease($entity['chronicDisease']);
        $model->setHasLearningIllness($entity['hasLearningIllness']);
        $model->setLearningIllness($entity['learningIllness']);
        $model->setStudyTime($entity['studyTime']);
        $model->setStudyMethodology($entity['studyMethodology']);
        $model->setSleepHours($entity['sleepHours']);
        $model->setFamilyHours($entity['familyHours']);
        $model->setFriendsHours($entity['friendsHours']);
        $model->setMateHours($entity['mateHours']);
        $model->setAnotherActivityTime($entity['anotherActivityTime']);
        $model->setFamilyCommunication($entity['familyCommunication']);
        $model->setSocialLifeTypeId($entity['socialLifeTypeId']);

        $exists = $this->existsSpecificSocialLife($model->getStudentId(), $model->getYear(), $model->getWeek());

        if ($exists)
        {
            $this->updateExistingStudentSocialLife($model);
        }
        else
        {
            $this->addNewStudentSocialLife($model);
        }
    }
    
    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentSocialLife($model)
    {
        try
        {
            $this->entityManager->persist($model);
            $this->entityManager->flush();
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }

    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function updateExistingStudentSocialLife($model)
    {
        try
        {
            $this->entityManager->merge($model);
            $this->entityManager->flush();
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }
}
