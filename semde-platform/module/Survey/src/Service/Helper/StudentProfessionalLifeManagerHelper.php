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
use Survey\Entity\StudentProfessionalLifeEntity;

/**
 * Description of StudentProfessionalLifeManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentProfessionalLifeManagerHelper
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
    public function getStudentProfessionalLifeById($id)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $items = $this->entityManager->getRepository(StudentProfessionalLifeEntity::class)->findBy(
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
    public function existsSpecificProfessionalLife($studentId, $year, $week)
    {
        $item = $this->entityManager->getRepository(StudentProfessionalLifeEntity::class)->find([
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
    public function addOrUpdateStudentProfessionalLife($entity)
    {
        //@TODO Change here to simulate the weeks
        $now = new DateTime();

        $model = new StudentProfessionalLifeEntity();

        $model->setUpdated($now->format('Y-m-d'));
        $model->setWeek($now->format('W'));
        $model->setYear($now->format('Y'));
        $model->setStudentId($entity['studentId']);

        $model->setHasScholarship($entity['hasScholarship']);
        $model->setScholarship($entity['scholarship']);
        $model->setStudiesLanguages($entity['studiesLanguages']);
        $model->setStudiesLanguagesPercentage($entity['studiesLanguagesPercentage']);
        $model->setStudiesWhichLanguages($entity['studiesWhichLanguages']);
        $model->setHandlesLanguages($entity['handlesLanguages']);
        $model->setHandlesLanguagesPercentage($entity['handlesLanguagesPercentage']);
        $model->setHandlesWhichLanguages($entity['handlesWhichLanguages']);
        $model->setCareerMotivation($entity['careerMotivation']);
        $model->setHobbies($entity['hobbies']);
        $model->setSelfDescription($entity['selfDescription']);
        $model->setCareerId($entity['careerId']);

        $exists = $this->existsSpecificProfessionalLife($model->getStudentId(), $model->getYear(), $model->getWeek());

        if ($exists)
        {
            $this->updateExistingStudentProfessionalLife($model);
        }
        else
        {
            $this->addNewStudentProfessionalLife($model);
        }
    }

    /**
     * 
     * @param type $model
     * @throws \Survey\Service\Helper\Exception
     */
    public function addNewStudentProfessionalLife($model)
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
    public function updateExistingStudentProfessionalLife($model)
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
