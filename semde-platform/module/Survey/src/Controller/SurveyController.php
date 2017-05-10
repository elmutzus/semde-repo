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
use Survey\Form\StudentStatusForm;
use Survey\Controller\Helper\StudentControllerHelper;
use Survey\Controller\Helper\StudentStatusControllerHelper;

/**
 * Description of SurveyController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class SurveyController extends AbstractActionController
{

    /**
     *
     * @var type 
     */
    private $surveyManager;

    /**
     *
     * @var type 
     */
    private $sessionContainer;

    /**
     *
     * @var type 
     */
    private $studentStatusInstance;

    /**
     *
     * @var type 
     */
    private $studentInstance;

    /**
     * 
     * @param type $roleManager
     * @param type $sessionContainer
     */
    public function __construct($roleManager, $sessionContainer)
    {
        $this->surveyManager         = $roleManager;
        $this->sessionContainer      = $sessionContainer;
        $this->studentStatusInstance = new StudentStatusControllerHelper($this->surveyManager);
        $this->studentInstance       = new StudentControllerHelper();
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

    private function validateAuthentication($id, $idSecret)
    {
        if ($id != '-')
        {
            return true;
        }
    }

    public function addOrUpdateStudentAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = '';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

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

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentStatus', 'id' => $data['id']]);
            }
        }

        $existingData = $this->surveyManager->getStudentById($idUser);

        $form = $this->studentInstance->fillFormData($form, $existingData, $idUser);

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentStatusAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = '';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentStatusForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            $form = $this->studentStatusInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $form = $this->studentStatusInstance->getUpdatedFormData($form);
                
                $this->surveyManager->addOrUpdateStudentStatus($form->getData());

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentAddress', 'id' => $data['studentId']]);
            }
        }

        $existingData = $this->surveyManager->getStudentStatusById($idUser);

        $form = $this->studentStatusInstance->fillFormData($form, $existingData, $idUser);

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

}
