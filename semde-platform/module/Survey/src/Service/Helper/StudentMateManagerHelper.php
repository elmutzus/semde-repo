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
use Survey\Entity\StudentMateEntity;

/**
 * Description of StudentMateManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentMateManagerHelper
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
    public function getStudentMateById($id)
    {
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentMateEntity::class)->findBy(
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
    public function existsSpecificMate($studentId, $year, $week)
    {
        $item = $this->entityManager->getRepository(StudentMateEntity::class)->find([
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
    public function addOrUpdateStudentMate($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentMateEntity();

        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));
        $model->setStudentId($entity['studentId']);

        $model->setBirthdate(($entity['birthdate'] == '') ? null : $entity['birthdate']);
        $model->setOccupation($entity['occupation']);
        $model->setWorks($entity['works']);
        $model->setAcademicTitle($entity['academicTitle']);
        $model->setTimeTogether($entity['timeTogether']);
        $model->setCommunication($entity['communication']);
        $model->setGender($entity['gender']);
        $model->setActiveSexLife($entity['activeSexLife']);
        $model->setRelationshipId($entity['relationshipId']);

        $exists = $this->existsSpecificMate($model->getStudentId(), $model->getYear(), $model->getWeek());

        if ($exists)
        {
            $this->updateExistingStudentMate($model);
        }
        else
        {
            $this->addNewStudentMate($model);
        }
    }

    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentMate($model)
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
    public function updateExistingStudentMate($model)
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
