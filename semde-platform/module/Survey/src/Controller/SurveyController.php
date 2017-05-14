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
use Survey\Form\StudentAddressForm;
use Survey\Form\StudentProfessionalLifeForm;
use Survey\Form\StudentParentForm;
use Survey\Form\StudentBrotherForm;
use Survey\Form\StudentMateForm;
use Survey\Controller\Helper\StudentControllerHelper;
use Survey\Controller\Helper\StudentStatusControllerHelper;
use Survey\Controller\Helper\StudentAddressControllerHelper;
use Survey\Controller\Helper\StudentProfessionalLifeControllerHelper;
use Survey\Controller\Helper\StudentParentControllerHelper;
use Survey\Controller\Helper\StudentBrotherControllerHelper;
use Survey\Controller\Helper\StudentMateControllerHelper;

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
     * @var type 
     */
    private $studentAddressInstance;

    /**
     *
     * @var type 
     */
    private $studentProfessionalLifeInstance;

    /**
     *
     * @var type 
     */
    private $studentParentInstance;

    /**
     *
     * @var type 
     */
    private $studentBrotherInstance;
    
    /**
     *
     * @var type 
     */
    private $studentMateInstance;

    /**
     * 
     * @param type $roleManager
     * @param type $sessionContainer
     */
    public function __construct($roleManager, $sessionContainer)
    {
        $this->surveyManager                   = $roleManager;
        $this->sessionContainer                = $sessionContainer;
        $this->studentStatusInstance           = new StudentStatusControllerHelper($this->surveyManager);
        $this->studentInstance                 = new StudentControllerHelper();
        $this->studentAddressInstance          = new StudentAddressControllerHelper($this->surveyManager);
        $this->studentProfessionalLifeInstance = new StudentProfessionalLifeControllerHelper($this->surveyManager);
        $this->studentParentInstance           = new StudentParentControllerHelper($this->surveyManager);
        $this->studentBrotherInstance          = new StudentBrotherControllerHelper($this->surveyManager);
        $this->studentMateInstance = new StudentMateControllerHelper($this->surveyManager);
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

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentAddress', 'id' => $data['id']]);
            }
        }

        $existingData = $this->surveyManager->getStudentById($idUser);

        $form = $this->studentInstance->fillFormData($form, $existingData, $idUser);

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentAddressAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = '';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentAddressForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $this->surveyManager->addOrUpdateStudentAddress($form->getData());

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentStatus', 'id' => $data['studentId']]);
            }
            else
            {
                $this->studentAddressInstance->fillOptionsData($form);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentAddressById($idUser);

            $form = $this->studentAddressInstance->fillFormData($form, $existingData, $idUser);
        }

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
                $data = $form->getData();

                $data = $this->studentStatusInstance->getUpdatedFormData($data);

                $this->surveyManager->addOrUpdateStudentStatus($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentProfessionalLife', 'id' => $data['studentId']]);
            }
            else
            {
                $this->studentStatusInstance->fillOptionsData($form);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentStatusById($idUser);

            $form = $this->studentStatusInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentProfessionalLifeAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = '';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentProfessionalLifeForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            $form = $this->studentProfessionalLifeInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $data = $form->getData();

                $data = $this->studentProfessionalLifeInstance->getUpdatedFormData($data);

                $this->surveyManager->addOrUpdateStudentProfessionalLife($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentFather', 'id' => $data['studentId']]);
            }
            else
            {
                $this->studentProfessionalLifeInstance->fillOptionsData($form);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentProfessionalLifeById($idUser);

            $form = $this->studentProfessionalLifeInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentFatherAction()
    {
        $this->setLayoutVariables();

        $id         = $this->params()->fromRoute('id', '-');
        $idUser     = $id;
        $idSecret   = '';
        $parentType = 'F';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentParentForm();

        if ($this->getRequest()->isPost())
        {
            $data               = $this->params()->fromPost();
            $data['parentType'] = $parentType;

            $form->setData($data);

            $form = $this->studentParentInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $data = $form->getData();

                $data = $this->studentParentInstance->getUpdatedFormData($data);

                $this->surveyManager->addOrUpdateStudentParent($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentMother', 'id' => $data['studentId']]);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentParentById($idUser, $parentType);

            $form = $this->studentParentInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentMotherAction()
    {
        $this->setLayoutVariables();

        $id         = $this->params()->fromRoute('id', '-');
        $idUser     = $id;
        $idSecret   = '';
        $parentType = 'M';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentParentForm();

        if ($this->getRequest()->isPost())
        {
            $data               = $this->params()->fromPost();
            $data['parentType'] = $parentType;

            $form->setData($data);

            $form = $this->studentParentInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $data = $form->getData();

                $data = $this->studentParentInstance->getUpdatedFormData($data);

                $this->surveyManager->addOrUpdateStudentParent($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentBrother', 'id' => $data['studentId']]);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentParentById($idUser, $parentType);

            $form = $this->studentParentInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentBrotherAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = '';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentBrotherForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            $form = $this->studentBrotherInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $data = $form->getData();

                $data = $this->studentBrotherInstance->getUpdatedFormData($data);

                $this->surveyManager->addOrUpdateStudentBrother($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentMate', 'id' => $data['studentId']]);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentBrotherById($idUser);

            $form = $this->studentBrotherInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }
    
    public function addOrUpdateStudentMateAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = '';

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentMateForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            $form = $this->studentMateInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $data = $form->getData();

                $data = $this->studentMateInstance->getUpdatedFormData($data);

                $this->surveyManager->addOrUpdateStudentMate($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentSocialLife', 'id' => $data['studentId']]);
            }
            else
            {
                $this->studentMateInstance->fillOptionsData($form);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentMateById($idUser);

            $form = $this->studentMateInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }
}
