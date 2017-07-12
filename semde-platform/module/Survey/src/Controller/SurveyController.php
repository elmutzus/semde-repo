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
use Survey\Form\StudentSocialLifeForm;
use Survey\Controller\Helper\StudentControllerHelper;
use Survey\Controller\Helper\StudentStatusControllerHelper;
use Survey\Controller\Helper\StudentAddressControllerHelper;
use Survey\Controller\Helper\StudentProfessionalLifeControllerHelper;
use Survey\Controller\Helper\StudentParentControllerHelper;
use Survey\Controller\Helper\StudentBrotherControllerHelper;
use Survey\Controller\Helper\StudentMateControllerHelper;
use Survey\Controller\Helper\StudentSocialLifeControllerHelper;
use Zend\Crypt\Password\Bcrypt;

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
     * @var type 
     */
    private $studentSocialLifeInstance;

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
        $this->studentMateInstance             = new StudentMateControllerHelper($this->surveyManager);
        $this->studentSocialLifeInstance       = new StudentSocialLifeControllerHelper($this->surveyManager);
    }

    /**
     * 
     */
    private function setLayoutVariables()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/authenticated');
        $layout->setVariable('reportPages', $this->sessionContainer->reportPages);
        $layout->setVariable('managementPages', $this->sessionContainer->managementPages);
        $layout->setVariable('currentUser', $this->sessionContainer->currentUserName);
        $layout->setVariable('currentUserRole', $this->sessionContainer->currentUserRole);
    }
    
    /**
     * 
     * @param type $id
     * @param type $idSecret
     * @return boolean
     */
    private function isIdSecretValid($id, $idSecret){
        
        $now = new \DateTime();
        
        $realKeyString = 'Y' . $now->format('Y') . 'W' . $now->format('W') . 'C' . $id . 'GwH28';
        
        $bcrypt     = new Bcrypt();
        $realKey = $bcrypt->create($realKeyString);
        
        return $realKey == $idSecret;
    }

    /**
     * 
     * @param type $id
     * @param type $idSecret
     * @return boolean
     */
    private function validateAuthentication($id, $idSecret)
    {
        if (\strlen($id) > 0)
        {
            return $this->isIdSecretValid($id, $idSecret);
        }

        return false;
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function addOrUpdateStudentAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = $this->params()->fromRoute('idSecret', '-');

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
        $idSecret = $this->params()->fromRoute('idSecret', '-');

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
        $idSecret = $this->params()->fromRoute('idSecret', '-');

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
        $idSecret = $this->params()->fromRoute('idSecret', '-');

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
        $idSecret = $this->params()->fromRoute('idSecret', '-');
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
        $idSecret = $this->params()->fromRoute('idSecret', '-');
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
        $idSecret = $this->params()->fromRoute('idSecret', '-');

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
        $idSecret = $this->params()->fromRoute('idSecret', '-');

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

    public function addOrUpdateStudentSocialLifeAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = $this->params()->fromRoute('idSecret', '-');

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $form = new StudentSocialLifeForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            $form = $this->studentSocialLifeInstance->getUpdatedControlsBasedOnValidation($form);

            if ($form->isvalid())
            {
                $data = $form->getData();

                $this->surveyManager->addOrUpdateStudentSocialLife($data);

                return $this->redirect()->toRoute('surveyManagementRoute', ['action' => 'addOrUpdateStudentFinish', 'id' => $data['studentId']]);
            }
            else
            {
                $this->studentSocialLifeInstance->fillOptionsData($form);
            }
        }
        else
        {
            $existingData = $this->surveyManager->getStudentSocialLifeById($idUser);

            $form = $this->studentSocialLifeInstance->fillFormData($form, $existingData, $idUser);
        }

        return new ViewModel([
            'form' => $form,
            'id'   => $idUser,
        ]);
    }

    public function addOrUpdateStudentFinishAction()
    {
        $this->setLayoutVariables();

        $id       = $this->params()->fromRoute('id', '-');
        $idUser   = $id;
        $idSecret = $this->params()->fromRoute('idSecret', '-');

        if (!$this->validateAuthentication($idUser, $idSecret))
        {
            throw new \Exception('No puede modificar la información solicitada');
        }

        $student = $this->surveyManager->getStudentById($idUser);

        return new ViewModel([
            'id'       => $student->getId(),
            'fullname' => $student->getLastname() . ', ' . $student->getName(),
        ]);
    }

    public function addOrUpdateStudentDepartmentsAction()
    {
        $id = $this->params()->fromRoute('id', '-');

        if ($id == '-')
        {
            throw new \Exception('No se recibió el departamento correcto');
        }

        $towns = $this->surveyManager->getTownOptions($id);

        $view = new ViewModel();
        $view->setTerminal(true);
        $view->setVariable('towns', $towns);

        return $view;
    }

}
