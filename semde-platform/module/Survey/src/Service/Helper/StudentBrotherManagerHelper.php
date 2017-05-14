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
use Survey\Entity\StudentBrotherEntity;

/**
 * Description of StudentBrotherManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentBrotherManagerHelper
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
    public function getStudentBrotherById($id)
    {
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentBrotherEntity::class)->findBy(
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
     * @return boolean
     */
    public function existsSpecificBrother($studentId, $year, $week)
    {
        $item = $this->entityManager->getRepository(StudentBrotherEntity::class)->find([
            'year'       => $year,
            'week'       => $week,
            'studentId'  => $studentId,
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
    public function addOrUpdateStudentBrother($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentBrotherEntity();

        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));
        $model->setStudentId($entity['studentId']);

        $model->setQuantity($entity['quantity']);
        $model->setPlace($entity['place']);
        $model->setAcademicTitle($entity['academicTitle']);
        $model->setCommunication($entity['communication']);
        $model->setHasChronicDisease($entity['hasChronicDisease']);
        $model->setChronicDisease($entity['chronicDisease']);
        $model->setHasLearningIllness($entity['learningIllness']);
        $model->setLearningIllness($entity['learningIllness']);

        $exists = $this->existsSpecificBrother($model->getStudentId(), $model->getYear(), $model->getWeek());

        if ($exists)
        {
            $this->updateExistingStudentBrother($model);
        }
        else
        {
            $this->addNewStudentBrother($model);
        }
    }
    
    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentBrother($model)
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
    public function updateExistingStudentBrother($model)
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
