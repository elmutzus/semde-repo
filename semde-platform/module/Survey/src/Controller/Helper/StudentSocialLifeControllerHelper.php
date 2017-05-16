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
 * Description of StudentSocialLifeControllerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentSocialLifeControllerHelper
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
    private function fillSocialLifeTypeData($form)
    {
        $options = $this->surveyManager->getSocialLifeTypeOptions();

        $selectElement = $form->get('socialLifeTypeId');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    public function fillOptionsData($form)
    {
        $this->fillSocialLifeTypeData($form);
    }

    /**
     * Updates the filters based on the selection in the form
     * @param type $form
     * @return type
     */
    public function getUpdatedControlsBasedOnValidation($form)
    {
        $socialLifeTypeId = $form->get('socialLifeTypeId')->getValue();

        $form->getInputFilter()->get('socialLifeOther')->setAllowEmpty(($socialLifeTypeId == '6' ? false : true));

        $exercises = $form->get('exercises')->getValue();

        $form->getInputFilter()->get('exercisesWhich')->setAllowEmpty(($exercises == '1' ? false : true));
        $form->getInputFilter()->get('exercisesFrequency')->setAllowEmpty(($exercises == '1' ? false : true));

        $drinksAlcohol = $form->get('drinksAlcohol')->getValue();

        $form->getInputFilter()->get('drinksAlcoholFrequency')->setAllowEmpty(($drinksAlcohol == '1' ? false : true));

        $smokes = $form->get('smokes')->getValue();

        $form->getInputFilter()->get('smokesFrequency')->setAllowEmpty(($smokes == '1' ? false : true));

        $hasChronicDisease = $form->get('hasChronicDisease')->getValue();

        $form->getInputFilter()->get('chronicDisease')->setAllowEmpty(($hasChronicDisease == '1' ? false : true));

        $hasLearningIllness = $form->get('hasLearningIllness')->getValue();

        $form->getInputFilter()->get('learningIllness')->setAllowEmpty(($hasLearningIllness == '1' ? false : true));

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
        $this->fillOptionsData($form);

        $form->get('studentId')->setValue($studentId);

        if ($existingData == null)
        {
            return $form;
        }

        $form->get('week')->setValue($existingData->getWeek());
        $form->get('year')->setValue($existingData->getYear());

        $form->get('socialLifeTypeId')->setValue($existingData->getSocialLifeTypeId());
        $form->get('socialLifeOther')->setValue($existingData->getSocialLifeOther());
        $form->get('exercises')->setValue($existingData->getExercises());
        $form->get('exercisesWhich')->setValue($existingData->getExercisesWhich());
        $form->get('exercisesFrequency')->setValue($existingData->getExercisesFrequency());
        $form->get('drinksAlcohol')->setValue($existingData->getDrinksAlcohol());
        $form->get('drinksAlcoholFrequency')->setValue($existingData->getDrinksAlcoholFrequency());
        $form->get('smokes')->setValue($existingData->getSmokes());
        $form->get('smokesFrequency')->setValue($existingData->getSmokesFrequency());
        $form->get('hasChronicDisease')->setValue($existingData->getHasChronicDisease());
        $form->get('chronicDisease')->setValue($existingData->getChronicDisease());
        $form->get('hasLearningIllness')->setValue($existingData->getHasLearningIllness());
        $form->get('learningIllness')->setValue($existingData->getLearningIllness());
        $form->get('studyTime')->setValue($existingData->getStudyTime());
        $form->get('studyMethodology')->setValue($existingData->getStudyMethodology());
        $form->get('sleepHours')->setValue($existingData->getSleepHours());
        $form->get('familyHours')->setValue($existingData->getFamilyHours());
        $form->get('friendsHours')->setValue($existingData->getFriendsHours());
        $form->get('mateHours')->setValue($existingData->getMateHours());
        $form->get('anotherActivityTime')->setValue($existingData->getAnotherActivityTime());
        $form->get('familyCommunication')->setValue($existingData->getFamilyCommunication());

        return $form;
    }

}
