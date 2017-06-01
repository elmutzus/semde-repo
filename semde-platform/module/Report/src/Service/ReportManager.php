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
    private $auxiliaryHelper;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager, $surveyEntitymanager)
    {
        $this->entityManager   = $entityManager;
        $this->surveyEntityManager = $surveyEntitymanager;
        $this->report1Helper   = new Report1ManagerHelper($entityManager, $surveyEntitymanager);
        $this->auxiliaryHelper = new AuxiliaryEntityHelper($entityManager);
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

}
