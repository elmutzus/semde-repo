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

namespace Survey\Service;

use Survey\Service\Helper\StudentManagerHelper;
use Survey\Service\Helper\StudentStatusManagerHelper;
use Survey\Service\Helper\AuxiliaryEntityHelper;

/**
 * Description of SurveyManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class SurveyManager
{

    /**
     *
     * @var type 
     */
    private $entityManager;

    /**
     *
     * @var type StudentManagerHelper
     */
    private $studentHelper;

    /**
     *
     * @var type StudentStatusManagerHelper
     */
    private $studentStatusHelper;

    /**
     *
     * @var type AuxiliarEntityHelper
     */
    private $auxiliaryEntityHelper;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager         = $entityManager;
        $this->studentHelper         = new StudentManagerHelper($entityManager);
        $this->studentStatusHelper   = new StudentStatusManagerHelper($entityManager);
        $this->auxiliaryEntityHelper = new AuxiliaryEntityHelper($entityManager);
    }

    public function getEconomicHelpOptions()
    {
        return $this->auxiliaryEntityHelper->getEconomicHelpOptions();
    }

    /**
     * 
     * @return type
     */
    public function getLivingOptions()
    {
        return $this->auxiliaryEntityHelper->getLivingOptions();
    }

    /**
     * 
     * @return type
     */
    public function getTravelTimeOptions()
    {
        return $this->auxiliaryEntityHelper->getTravelTimeOptions();
    }

    /**
     * 
     * @return type
     */
    public function getMaritalStatusOptions()
    {
        return $this->auxiliaryEntityHelper->getMaritalStatusOptions();
    }

    /**
     * 
     * @return type
     */
    public function getTransportOptions()
    {
        return $this->auxiliaryEntityHelper->getTransportOptions();
    }

    /**
     * 
     * @param type $studentId
     * @param type $studentSecret
     * @return boolean
     */
    private function validateSurveyAccess($studentId, $studentSecret)
    {
        return true;
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getStudentById($id)
    {
        if ($this->validateSurveyAccess($id, '<Insert secret key here>'))
        {
            return $this->studentHelper->getStudentById($id);
        }
        else
        {
            throw new \Exception('No cuenta con acceso para modificar este estudiante');
        }
    }

    /**
     * 
     * @param type $newStudent
     */
    public function addOrUpdateStudent($newStudent)
    {
        if ($this->validateSurveyAccess($newStudent['id'], '<Insert secret key here>'))
        {
            $this->studentHelper->addOrUpdateStudent($newStudent);
        }
        else
        {
            throw new \Exception('No cuenta con acceso para modificar este estudiante');
        }
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getStudentStatusById($id)
    {
        if ($this->validateSurveyAccess($id, '<Insert secret key here>'))
        {
            return $this->studentStatusHelper->getStudentStatusById($id);
        }
        else
        {
            throw new \Exception('No cuenta con acceso para modificar este estudiante');
        }
    }

    /**
     * 
     * @param type $newStudentStatus
     */
    public function addOrUpdateStudentStatus($newStudentStatus)
    {
        if ($this->validateSurveyAccess($newStudentStatus['studentId'], '<Insert secret key here>'))
        {
            $this->studentStatusHelper->addOrUpdateStudentStatus($newStudentStatus);
        }
        else
        {
            throw new \Exception('No cuenta con acceso para modificar este estudiante');
        }
    }

}
