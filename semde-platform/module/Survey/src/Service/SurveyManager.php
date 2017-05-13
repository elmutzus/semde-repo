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
use Survey\Service\Helper\StudentAddressManagerHelper;
use Survey\Service\Helper\AuxiliaryEntityHelper;
use Survey\Service\Helper\StudentProfessionalLifeManagerHelper;

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
     * @var type StudentStatusManagerHelper
     */
    private $studentAddressHelper;

    /**
     *
     * @var type AuxiliarEntityHelper
     */
    private $auxiliaryEntityHelper;

    /**
     *
     * @var type 
     */
    private $studentProfessionalLifeHelper;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager                 = $entityManager;
        $this->studentHelper                 = new StudentManagerHelper($entityManager);
        $this->studentStatusHelper           = new StudentStatusManagerHelper($entityManager);
        $this->studentAddressHelper          = new StudentAddressManagerHelper($entityManager);
        $this->auxiliaryEntityHelper         = new AuxiliaryEntityHelper($entityManager);
        $this->studentProfessionalLifeHelper = new StudentProfessionalLifeManagerHelper($entityManager);
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
     * @return type
     */
    public function getDepartmentOptions()
    {
        return $this->auxiliaryEntityHelper->getDepartmentOptions();
    }

    /**
     * 
     * @return type
     */
    public function getTownOptions($id)
    {
        return $this->auxiliaryEntityHelper->getTownOptions($id);
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
     * @param type $id
     * @return type
     */
    public function getCareerOptions()
    {
        return $this->auxiliaryEntityHelper->getCareerOptions();
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

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getStudentAddressById($id)
    {
        return $this->studentAddressHelper->getStudentAddressById($id);
    }

    /**
     * 
     * @param type $newStudentStatus
     */
    public function addOrUpdateStudentAddress($newStudentAddress)
    {

        $this->studentAddressHelper->addOrUpdateStudentAddress($newStudentAddress);
    }

    /**
     * 
     * @param type $id
     * @return type
     */
    public function getStudentProfessionalLifeById($id)
    {
        return $this->studentProfessionalLifeHelper->getStudentProfessionalLifeById($id);
    }

    /**
     * 
     * @param type $newStudentProfessionalLife
     */
    public function addOrUpdateStudentProfessionalLife($newStudentProfessionalLife)
    {
        $this->studentProfessionalLifeHelper->addOrUpdateStudentProfessionalLife($newStudentProfessionalLife);
    }

}
