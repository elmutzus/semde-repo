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
 * Description of StudentStatusHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentStatusControllerHelper
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
    private function fillEconomicHelpData($form)
    {
        $options = $this->surveyManager->getEconomicHelpOptions();

        $selectElement = $form->get('economicHelpId');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    private function fillLivingData($form)
    {
        $options = $this->surveyManager->getLivingOptions();

        $selectElement = $form->get('livingId');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    private function fillTravelTimeData($form)
    {
        $options = $this->surveyManager->getTravelTimeOptions();

        $selectElement = $form->get('travelTimeId');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    private function fillMaritalStatusData($form)
    {
        $options = $this->surveyManager->getMaritalStatusOptions();

        $selectElement = $form->get('maritalStatusId');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    private function fillTransportData($form)
    {
        $options = $this->surveyManager->getTransportOptions();

        $selectElement = $form->get('transportId');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     * @param type $existingData
     * @return type
     */
    public function fillFormData($form, $existingData)
    {
        $this->fillEconomicHelpData($form);
        $this->fillLivingData($form);
        $this->fillMaritalStatusData($form);
        $this->fillTransportData($form);
        $this->fillTravelTimeData($form);

        if ($existingData == null)
        {
            return $form;
        }

        $form->get('studentId')->setValue($existingData->getStudentId());
        $form->get('semester')->setValue($existingData->getSemester());
        $form->get('repeatedSemesters')->setValue($existingData->getRepeatedSemesters());
        $form->get('religion')->setValue($existingData->getReligion());
        $form->get('professing')->setValue($existingData->getProfessing());
        $form->get('works')->setValue($existingData->getWorks());
        $form->get('jobDescription')->setValue($existingData->getJobDescription());
        $form->get('highschool')->setValue($existingData->getHighschool());
        $form->get('livesWithOther')->setValue($existingData->getLivesWithOther());
        $form->get('otherEconomicHelp')->setValue($existingData->getOtherEconomicHelp());
        $form->get('maritalStatusId')->setValue($existingData->getMaritalStatusId());
        $form->get('livingId')->setValue($existingData->getLivingId());
        $form->get('travelTimeId')->setValue($existingData->getTravelTime());
        $form->get('transportId')->setValue($existingData->getTransportId());
        $form->get('economicHelpId')->setValue($existingData->getEconomicHelpId());

        return $form;
    }

}
