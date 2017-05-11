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
use Survey\Entity\StudentAddressEntity;

/**
 * Description of AddressManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentAddressManagerHelper
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
    public function getStudentAddressById($id)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentAddressEntity::class)->findBy(
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
    public function existsSpecificAddress($studentId, $year, $week)
    {
        $item = $this->entityManager->getRepository(StudentAddressEntity::class)->find([
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
    public function addOrUpdateStudentAddress($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentAddressEntity();
        
        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));
        $model->setStudentId($entity['studentId']);
        $model->setZone($entity['zone']);
        $model->setAnotherSector($entity['anotherSector']);
        $model->setTownId($entity['townId']);
        $model->setDepartmentId($entity['departmentId']);

        $exists = $this->existsSpecificAddress($model->getStudentId(), $model->getYear(), $model->getWeek());

        if ($exists)
        {
            $this->updateExistingStudentAddress($model);
        }
        else
        {
            $this->addNewStudentAddress($model);
        }
    }

    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentAddress($model)
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
    public function updateExistingStudentAddress($model)
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
