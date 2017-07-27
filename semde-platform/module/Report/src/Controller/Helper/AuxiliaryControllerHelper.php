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

namespace Report\Controller\Helper;

/**
 * Description of Report1ControllerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class AuxiliaryControllerHelper
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
    private function fillCareerData($form)
    {
        $options = $this->surveyManager->getCareerOptions();

        $selectElement = $form->get('career');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    private function fillCourseData($form)
    {
        $options = $this->surveyManager->getCourseOptions();

        $selectElement = $form->get('course');

        $selectElement->setValueOptions($options);
    }

    /**
     * 
     * @param type $form
     */
    public function fillOptionsData($form)
    {
        $this->fillCareerData($form);
        $this->fillCourseData($form);

        return $form;
    }

    /**
     * 
     * @param type $studentNov
     * @param type $form
     * @return type
     */
    public function fillAreasData($studentNov, $form)
    {
        $options = $this->surveyManager->getReport4AvailableAreas($studentNov);

        $selectElement = $form->get('areaType');

        $selectElement->setValueOptions($options);

        return $form;
    }

}
