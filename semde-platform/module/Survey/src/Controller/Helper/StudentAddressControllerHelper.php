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

namespace Survey\Controller\Helper;

/**
 * Description of AddressControllerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentAddressControllerHelper 
{
    /**
     *
     * @var type 
     */
    private $surveyManager;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->surveyManager = $entityManager;
    }
    
    /**
     * 
     * @param type $form
     */
    private function fillDepartmentData($form)
    {
        $options = $this->surveyManager->getDepartmentOptions();

        $selectElement = $form->get('departmentId');

        $selectElement->setValueOptions($options);
    }
    
    /**
     * 
     * @param type $form
     */
    private function fillTownData($form)
    {
        $options = $this->surveyManager->getTownOptions($form->get('departmentId')->getValue());

        $selectElement = $form->get('townId');

        $selectElement->setValueOptions($options);
    }
    
    /**
     * 
     * @param type $form
     */
    public function fillOptionsData($form)
    {
        $this->fillDepartmentData($form);
        $this->fillTownData($form);
    }

    /**
     * 
     * @param type $form
     * @param type $existingData
     * @param type $studentId
     * @return type
     */
    public function fillFormData($form, $existingData, $studentId)
    {
        $this->fillOptionsData($form);
        
        $form->get('studentId')->setValue($studentId);

        if ($existingData == null)
        {
            return $form;
        }

        $form->get('week')->setValue($existingData->getWeek());
        $form->get('year')->setValue($existingData->getYear());

        $form->get('zone')->setValue($existingData->getZone());
        $form->get('anotherSector')->setValue($existingData->getAnotherSector());
        $form->get('townId')->setValue($existingData->getTownId());
        $form->get('departmentId')->setValue($existingData->getDepartmentId());

        return $form;
    }
}
