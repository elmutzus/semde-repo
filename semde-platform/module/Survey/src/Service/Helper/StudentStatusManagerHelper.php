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
use Survey\Entity\StudentStatusEntity;

/**
 * Description of StudentStatusManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentStatusManagerHelper
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
    public function getStudentStatusById($id)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentStatusEntity::class)->findBy(
                ['year' => $now->format('Y'), 'studentId' => $id,], ['week' => 'DESC',]
        );
        
        if(sizeof($items) >= 1)
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
    public function existsSpecificStatus($studentId, $year, $week)
    {
        $item = $this->entityManager->getRepository(StudentStatusEntity::class)->find([
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
    public function addOrUpdateStudentStatus($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentStatusEntity();

        $model->setEconomicHelpId($entity['economicHelpId']);
        $model->setHighschool($entity['highschool']);
        $model->setJobDescription($entity['jobDescription']);
        $model->setLivesWithOther($entity['livesWithOther']);
        $model->setLivingId($entity['livingId']);
        $model->setMaritalStatusId($entity['maritalStatusId']);
        $model->setOtherEconomicHelp($entity['otherEconomicHelp']);
        $model->setProfessing($entity['professing']);
        $model->setReligion($entity['religion']);
        $model->setRepeatedSemesters($entity['repeatedSemesters']);
        $model->setSemester($entity['semester']);
        $model->setStudentId($entity['studentId']);
        $model->setTransportId($entity['transportId']);
        $model->setTravelTimeId($entity['travelTimeId']);
        $model->setWorks($entity['works']);
        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));

        $exists = $this->existsSpecificStatus($model->getStudentId(), $model->getYear(), $model->getWeek());

        if ($exists)
        {
            $this->updateExistingStudentStatus($model);
        }
        else
        {
            $this->addNewStudentStatus($model);
        }
    }

    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentStatus($model)
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
    public function updateExistingStudentStatus($model)
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
