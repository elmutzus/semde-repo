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

        return $form;
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
     */
    public function fillOptionsData($form)
    {
        $this->fillEconomicHelpData($form);
        $this->fillLivingData($form);
        $this->fillMaritalStatusData($form);
        $this->fillTransportData($form);
        $this->fillTravelTimeData($form);
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
        $form->get('travelTimeId')->setValue($existingData->getTravelTimeId());
        $form->get('transportId')->setValue($existingData->getTransportId());
        $form->get('economicHelpId')->setValue($existingData->getEconomicHelpId());
        $form->get('movedOn')->setValue($existingData->getMovedOn());
        $form->get('movedOnSolution')->setValue($existingData->getMovedOnSolution());

        return $form;
    }

    /**
     * Updates the filters based on the selection in the form
     * @param type $form
     * @return type
     */
    public function getUpdatedControlsBasedOnValidation($form)
    {
        $works = $form->get('works')->getValue();

        $form->getInputFilter()->get('jobDescription')->setAllowEmpty(($works == '1' ? false : true));

        $livingId = $form->get('livingId')->getValue();

        $form->getInputFilter()->get('livesWithOther')->setAllowEmpty(($livingId == '12' ? false : true));

        $economicHelpId = $form->get('economicHelpId')->getValue();

        $form->getInputFilter()->get('otherEconomicHelp')->setAllowEmpty(($economicHelpId == '8' ? false : true));
        
        $movedOn = $form->get('movedOn')->getValue();

        $form->getInputFilter()->get('movedOnSolution')->setAllowEmpty(($movedOn == '1' ? false : true));

        return $form;
    }

    /**
     * Updates the fields based on its requirements if selected options
     * @param type $data
     * @return type
     */
    public function getUpdatedFormData($data)
    {
        $works = $data['works'];

        if ($works != '1')
        {
            $data['jobDescription'] = '';
        }

        $livingId = $data['livingId'];

        if ($livingId != '12')
        {
            $data['livesWithOther'] = '';
        }

        $economicHelpId = $data['economicHelpId'];

        if ($economicHelpId != '8')
        {
            $data['otherEconomicHelp'] = '';
        }
        
        $movedOn = $data['movedOn'];

        if ($movedOn != '1')
        {
            $data['movedOnSolution'] = '';
        }

        return $data;
    }

}
