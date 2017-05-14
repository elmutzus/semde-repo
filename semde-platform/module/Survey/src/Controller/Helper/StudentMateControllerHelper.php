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
 * Description of StudentMateControllerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentMateControllerHelper
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
    private function fillRelationshipData($form)
    {
        $options = $this->surveyManager->getRelationshipOptions();

        $selectElement = $form->get('relationshipId');

        $selectElement->setValueOptions($options);
    }
    
    /**
     * 
     * @param type $form
     */
    public function fillOptionsData($form)
    {
        $this->fillRelationshipData($form);
    }

    /**
     * Updates the filters based on the selection in the form
     * @param type $form
     * @return type
     */
    public function getUpdatedControlsBasedOnValidation($form)
    {
        $relationshipId = $form->get('relationshipId')->getValue();

        $form->getInputFilter()->get('birthdate')->setAllowEmpty(($relationshipId == '1' ? false : true));
        $form->getInputFilter()->get('occupation')->setAllowEmpty(($relationshipId == '1' ? false : true));
        $form->getInputFilter()->get('academicTitle')->setAllowEmpty(($relationshipId == '1' ? false : true));
        $form->getInputFilter()->get('timeTogether')->setAllowEmpty(($relationshipId == '1' ? false : true));
        $form->getInputFilter()->get('communication')->setAllowEmpty(($relationshipId == '1' ? false : true));

        return $form;
    }

    /**
     * Updates the fields based on its requirements if selected options
     * @param type $data
     * @return type
     */
    public function getUpdatedFormData($data)
    {
        $relationshipId = $data['relationshipId'];

        if ($relationshipId == '0')
        {
            $data['birthdate']     = null;
            $data['occupation']    = '';
            $data['academicTitle'] = '';
            $data['timeTogether']  = '';
            $data['communication'] = '';
        }

        return $data;
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

        $form->get('birthdate')->setValue($existingData->getBirthdate());
        $form->get('occupation')->setValue($existingData->getOccupation());
        $form->get('works')->setValue($existingData->getWorks());
        $form->get('academicTitle')->setValue($existingData->getAcademicTitle());
        $form->get('timeTogether')->setValue($existingData->getTimeTogether());
        $form->get('communication')->setValue($existingData->getCommunication());
        $form->get('gender')->setValue($existingData->getGender());
        $form->get('activeSexLife')->setValue($existingData->getActiveSexLife());
        $form->get('relationshipId')->setValue($existingData->getRelationshipId());

        return $form;
    }

}
