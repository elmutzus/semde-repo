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
use Survey\Entity\StudentParentEntity;

/**
 * Description of StudentParentManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentParentManagerHelper
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
    public function getStudentParentById($id, $parentType)
    {
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentParentEntity::class)->findBy(
                ['year' => $now->format('Y'), 'studentId' => $id, 'parentType' => $parentType,], ['week' => 'DESC',]
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
    public function existsSpecificParent($studentId, $year, $week, $parentType)
    {
        $item = $this->entityManager->getRepository(StudentParentEntity::class)->find([
            'year'       => $year,
            'week'       => $week,
            'studentId'  => $studentId,
            'parentType' => $parentType,
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
    public function addOrUpdateStudentParent($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentParentEntity();

        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));
        $model->setStudentId($entity['studentId']);
        $model->setParentType($entity['parentType']);

        $model->setLives($entity['lives']);
        $model->setBirthdate($entity['birthdate']);
        $model->setOccupation($entity['occupation']);
        $model->setWorks($entity['works']);
        $model->setAcademicTitle($entity['academicTitle']);
        $model->setCommunication($entity['communication']);
        $model->setHasChronicDisease($entity['hasChronicDisease']);
        $model->setChronicDisease($entity['chronicDisease']);
        $model->setHasLearningIllness($entity['learningIllness']);
        $model->setLearningIllness($entity['learningIllness']);

        $exists = $this->existsSpecificParent($model->getStudentId(), $model->getYear(), $model->getWeek(), $model->getParentType());

        if ($exists)
        {
            $this->updateExistingStudentParent($model);
        }
        else
        {
            $this->addNewStudentParent($model);
        }
    }

    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentParent($model)
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
    public function updateExistingStudentParent($model)
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
