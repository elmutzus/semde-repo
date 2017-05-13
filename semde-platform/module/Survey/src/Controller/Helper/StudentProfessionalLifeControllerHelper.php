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
 * Description of StudentProfessionalLifeControllerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentProfessionalLifeControllerHelper
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
        $hasScholarship = $form->get('hasScholarship')->getValue();

        $form->getInputFilter()->get('scholarship')->setAllowEmpty(($hasScholarship == '1' ? false : true));

        $studiesLanguages = $form->get('studiesLanguages')->getValue();

        $form->getInputFilter()->get('studiesLanguagesPercentage')->setAllowEmpty(($studiesLanguages == '1' ? false : true));
        $form->getInputFilter()->get('studiesWhichLanguages')->setAllowEmpty(($studiesLanguages == '1' ? false : true));

        $handlesLanguages = $form->get('handlesLanguages')->getValue();

        $form->getInputFilter()->get('handlesLanguagesPercentage')->setAllowEmpty(($handlesLanguages == '1' ? false : true));
        $form->getInputFilter()->get('handlesWhichLanguages')->setAllowEmpty(($handlesLanguages == '1' ? false : true));
        
        return $form;
    }
    
    /**
     * Updates the fields based on its requirements if selected options
     * @param type $data
     * @return type
     */
    public function getUpdatedFormData($data)
    {
        $works = $data['hasScholarship'];

        if ($works != '1')
        {
            $data['scholarship'] = '';
        }

        $studiesLanguages = $data['studiesLanguages'];

        if ($studiesLanguages != '1')
        {
            $data['studiesLanguagesPercentage'] = null;
            $data['studiesWhichLanguages'] = '';
        }

        $handlesLanguages = $data['handlesLanguages'];

        if ($handlesLanguages != '1')
        {
            $data['handlesLanguagesPercentage'] = null;
            $data['handlesWhichLanguages'] = '';
        }

        return $data;
    }
    
    /**
     * 
     * @param type $form
     */
    private function fillCareerData($form)
    {
        $options = $this->surveyManager->getCareerOptions();

        $selectElement = $form->get('careerId');

        $selectElement->setValueOptions($options);
    }
    
    
    /**
     * 
     * @param type $form
     */
    public function fillOptionsData($form)
    {
        $this->fillCareerData($form);
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

        $form->get('hasScholarship')->setValue($existingData->getHasScholarship());
        $form->get('scholarship')->setValue($existingData->getScholarship());
        $form->get('studiesLanguages')->setValue($existingData->getStudiesLanguages());
        $form->get('studiesWhichLanguages')->setValue($existingData->getStudiesWhichLanguages());
        $form->get('studiesLanguagesPercentage')->setValue($existingData->getStudiesLanguagesPercentage());
        $form->get('handlesLanguages')->setValue($existingData->getHandlesLanguages());
        $form->get('handlesLanguagesPercentage')->setValue($existingData->getHandlesLanguagesPercentage());
        $form->get('handlesWhichLanguages')->setValue($existingData->getHandlesWhichLanguages());
        $form->get('careerMotivation')->setValue($existingData->getCareerMotivation());
        $form->get('hobbies')->setValue($existingData->getHobbies());
        $form->get('selfDescription')->setValue($existingData->getSelfDescription());
        $form->get('careerId')->setValue($existingData->getCareerId());

        return $form;
    }
}
