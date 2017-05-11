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

use Survey\Entity\StudentEntity;

/**
 * Description of StudentManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentManagerHelper
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
    
    public function addOrUpdateStudent($newStudent)
    {
        $existingStudent = $this->getStudentById($newStudent['id']);

        if ($existingStudent == null)
        {
            $this->addNewStudent($newStudent);
        }
        else
        {
            $this->updateExistingStudent($newStudent);
        }
    }

    public function getStudentById($id)
    {
        $item = $this->entityManager->getRepository(StudentEntity::class)->findById($id);

        if (sizeof($item) == 1)
            return $item[0];

        return null;
    }

    public function addNewStudent($entity)
    {
        $model = new StudentEntity();

        $model->setId($entity['id']);
        $model->setDpi($entity['dpi']);
        $model->setNov($entity['nov']);
        $model->setName($entity['name']);
        $model->setLastname($entity['lastname']);
        $model->setBirthplace($entity['birthplace']);

        if ($entity['hiddenGender'] != '')
        {
            $model->setGender($entity['hiddenGender']);
        }
        else
        {
            $model->setGender($entity['gender']);
        }

        $model->setBirthdate($entity['birthdate']);

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

    public function updateExistingStudent($entity)
    {
        $model = new StudentEntity();

        $model->setId($entity['id']);
        $model->setDpi($entity['dpi']);
        $model->setNov($entity['nov']);
        $model->setName($entity['name']);
        $model->setLastname($entity['lastname']);
        $model->setGender($entity['gender']);
        $model->setBirthdate($entity['birthdate']);
        $model->setBirthplace($entity['birthplace']);

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
