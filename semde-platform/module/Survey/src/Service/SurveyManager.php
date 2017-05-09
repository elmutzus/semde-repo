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
use Survey\Service\Helper\AuxiliarEntityHelper;

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
    private $auxiliarEntityHelper;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager        = $entityManager;
        $this->studentHelper        = new StudentManagerHelper($entityManager);
        $this->studentStatusHelper  = new StudentStatusManagerHelper($entityManager);
        $this->auxiliarEntityHelper = new AuxiliarEntityHelper($entityManager);
    }

    public function getEconomicHelpOptions()
    {
        return $this->auxiliarEntityHelper->getEconomicHelpOptions();
    }
    
    public function getLivingOptions()
    {
        return $this->auxiliarEntityHelper->getLivingOptions();
    }
    
    public function getTravelTimeOptions()
    {
        return $this->auxiliarEntityHelper->getTravelTimeOptions();
    }
    
    public function getMaritalStatusOptions()
    {
        return $this->auxiliarEntityHelper->getMaritalStatusOptions();
    }
    
    public function getTransportOptions()
    {
        return $this->auxiliarEntityHelper->getTransportOptions();
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getStudentById($id)
    {
        return $this->studentHelper->getStudentById($id);
    }

    /**
     * 
     * @param type $newStudent
     */
    public function addOrUpdateStudent($newStudent)
    {
        $this->studentHelper->addOrUpdateStudent($newStudent);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getStudentStatusById($id)
    {
        return $this->studentStatusHelper->getStudentStatusById($id);
    }

    /**
     * 
     * @param type $newStudentStatus
     */
    public function addOrUpdateStudentStatus($newStudentStatus)
    {
        $this->studentStatusHelper->addOrUpdateStudentStatus($newStudentStatus);
    }

}
