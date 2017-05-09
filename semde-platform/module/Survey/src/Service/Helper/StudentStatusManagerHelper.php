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
        $currentTime = new DateTime();
        
        $item = $this->entityManager->getRepository(StudentStatusEntity::class)->find([
            'week' => $currentTime->format('W'),
            'year' => $currentTime->format('Y'),
            'studentId' => $id,
        ]);
        
        return $item;
    }

    /**
     * 
     * @param type $newStudentStatus
     */
    public function addOrUpdateStudentStatus($newStudentStatus)
    {
        $existingData = $this->getStudentStatusById($newStudentStatus['studentId']);

        if ($existingData == null)
        {
            $this->addNewStudentStatus($newStudentStatus);
        }
        else
        {
            $this->updateExistingStudentStatus($newStudentStatus);
        }
    }
    
    /**
     * 
     * @param type $entity
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentStatus($entity)
    {   
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
        
        $now = new DateTime();
        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));        
        $model->setYear($now->format('Y'));

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
     * @param type $entity
     * @throws \Survey\Service\Helper\Exception
     */
    public function updateExistingStudentStatus($entity)
    {   
        $model = new StudentStatusEntity();

        $model->setEconomicHelpId($entity['economicHelpId']);
        $model->setHighschool($entity['highschool']);
        $model->setId($entity['id']);
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
        
        $now = new DateTime();
        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));        
        $model->setYear($now->format('Y'));

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
