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

namespace Survey\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Survey\Form\StudentForm;

/**
 * Description of SurveyController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class SurveyController extends AbstractActionController
{
    /*
     * User manager
     */

    private $surveyManager;

    /*
     * Session container
     */
    private $sessionContainer;

    /*
     * Constructor
     */

    public function __construct($roleManager, $sessionContainer)
    {
        $this->surveyManager    = $roleManager;
        $this->sessionContainer = $sessionContainer;
    }

    private function setLayoutVariables()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/authenticated');
        $layout->setVariable('reportPages', $this->sessionContainer->reportPages);
        $layout->setVariable('managementPages', $this->sessionContainer->managementPages);
        $layout->setVariable('currentUser', $this->sessionContainer->currentUserName);
        $layout->setVariable('currentUserRole', $this->sessionContainer->currentUserRole);
    }

    private function validateAuthentication($id)
    {
        if ($id != '-')
        {
            return true;
        }
    }

    private function fillStudentFormData($form, $existingData)
    {
        if ($existingData == null)
        {
            return $form;
        }

        $form->get('id')->setValue($existingData->getId());
        $form->get('dpi')->setValue($existingData->getDpi());
        $form->get('nov')->setValue($existingData->getNov());
        $form->get('name')->setValue($existingData->getName());
        $form->get('lastname')->setValue($existingData->getLastname());
        $form->get('gender')->setValue($existingData->getGender());
        $form->get('birthdate')->setValue($existingData->getBirthdate());

        $form->get('id')->setAttribute('readonly', 'true');

        if ($existingData->getDpi() != '')
        {
            $form->get('dpi')->setAttribute('readonly', 'true');
        }

        if ($existingData->getNov() != '')
        {
            $form->get('nov')->setAttribute('readonly', 'true');
        }

        if ($existingData->getName() != '')
        {
            $form->get('name')->setAttribute('readonly', 'true');
        }

        if ($existingData->getLastname() != '')
        {
            $form->get('lastname')->setAttribute('readonly', 'true');
        }

        if ($existingData->getGender() != '')
        {
            $form->get('gender')->setAttribute('disabled', 'true');
            $form->get('hiddenGender')->setValue($existingData->getGender());
        }

        if ($existingData->getBirthdate() != '')
        {
            $form->get('birthdate')->setAttribute('readonly', 'true');
        }

        return $form;
    }

    public function addOrUpdateStudentAction()
    {
        $this->setLayoutVariables();

        $id = $this->params()->fromRoute('id', '-');

        $form = new StudentForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            if ($data['hiddenGender'] != '')
            {
                $data['gender'] = $data['hiddenGender'];
            }

            $form->setData($data);

            if ($form->isvalid())
            {
                $this->surveyManager->addOrUpdateStudent($form->getData());

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentStatus']);
            }
        }

        $existingData = $this->surveyManager->getStudentById($id);

        $form = $this->fillStudentFormData($form, $existingData);

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function addOrUpdateStudentStatusAction()
    {
        
    }

}
