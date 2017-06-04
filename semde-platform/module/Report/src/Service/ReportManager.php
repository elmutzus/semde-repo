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

namespace Report\Service;

use Report\Service\Helper\Report1ManagerHelper;
use Report\Service\Helper\Report2ManagerHelper;
use Report\Service\Helper\Report5ManagerHelper;
use Report\Service\Helper\AuxiliaryEntityHelper;

/**
 * Description of ReportManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class ReportManager
{

    /**
     *
     * @var type 
     */
    private $entityManager;

    /**
     *
     * @var type 
     */
    private $surveyEntityManager;

    /**
     *
     * @var type 
     */
    private $report1Helper;

    /**
     *
     * @var type 
     */
    private $report2Helper;
    
    /**
     *
     * @var type 
     */
    private $report5Helper;

    /**
     *
     * @var type 
     */
    private $auxiliaryHelper;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager, $surveyEntitymanager)
    {
        $this->entityManager       = $entityManager;
        $this->surveyEntityManager = $surveyEntitymanager;
        $this->report1Helper       = new Report1ManagerHelper($entityManager, $surveyEntitymanager);
        $this->auxiliaryHelper     = new AuxiliaryEntityHelper($entityManager);
        $this->report2Helper       = new Report2ManagerHelper($entityManager);
        $this->report5Helper       = new Report5ManagerHelper($entityManager);
    }

    /**
     * 
     * @return type
     */
    public function getCareerOptions()
    {
        return $this->auxiliaryHelper->getCareerOptions();
    }

    /**
     * 
     * @return type
     */
    public function getCourseOptions()
    {
        return $this->auxiliaryHelper->getCourseOptions();
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getReport1Data($data)
    {
        return $this->report1Helper->getQueryData($data);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getAddressDifferences($studentId)
    {
        return $this->report1Helper->getAddressDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getBrothersDifferences($studentId)
    {
        return $this->report1Helper->getBrothersDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getFatherDifferences($studentId)
    {
        return $this->report1Helper->getFatherDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getMateDifferences($studentId)
    {
        return $this->report1Helper->getMateDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getMotherDifferences($studentId)
    {
        return $this->report1Helper->getMotherDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getProfessionalLifeDifferences($studentId)
    {
        return $this->report1Helper->getProfessionalLifeDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getSocialLifeDifferences($studentId)
    {
        return $this->report1Helper->getSocialLifeDifferences($studentId);
    }

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getStudentStatusDifferences($studentId)
    {
        return $this->report1Helper->getStudentStatusDifferences($studentId);
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getReport2Data($data)
    {
        return $this->report2Helper->getQueryData($data);
    }

    /**
     * 
     * @param type $student
     * @return type
     */
    public function getReport2Detail($student)
    {
        return $this->report2Helper->getDetail($student);
    }

    /**
     * 
     * @param type $data
     * @return type
     */
    public function getReport5Data($data)
    {
        return $this->report5Helper->getQueryData($data);
    }
}
