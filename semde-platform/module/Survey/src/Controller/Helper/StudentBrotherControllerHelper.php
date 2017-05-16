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
 * Description of StudentBrotherControllerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentBrotherControllerHelper
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
     * Updates the filters based on the selection in the form
     * @param type $form
     * @return type
     */
    public function getUpdatedControlsBasedOnValidation($form)
    {        
        $hasDisease = $form->get('hasChronicDisease')->getValue();

        $form->getInputFilter()->get('chronicDisease')->setAllowEmpty(($hasDisease == '1' ? false : true));

        $learningIllness = $form->get('hasLearningIllness')->getValue();

        $form->getInputFilter()->get('learningIllness')->setAllowEmpty(($learningIllness == '1' ? false : true));

        return $form;
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
        $form->get('studentId')->setValue($studentId);

        if ($existingData == null)
        {
            return $form;
        }
        
        $form->get('week')->setValue($existingData->getWeek());
        $form->get('year')->setValue($existingData->getYear());

        $form->get('quantity')->setValue($existingData->getQuantity());
        $form->get('place')->setValue($existingData->getPlace());
        $form->get('academicTitle')->setValue($existingData->getAcademicTitle());
        $form->get('communication')->setValue($existingData->getCommunication());
        $form->get('hasChronicDisease')->setValue($existingData->getHasChronicDisease());
        $form->get('chronicDisease')->setValue($existingData->getChronicDisease());
        $form->get('hasLearningIllness')->setValue($existingData->getHasLearningIllness());
        $form->get('learningIllness')->setValue($existingData->getLearningIllness());

        return $form;
    }
}
