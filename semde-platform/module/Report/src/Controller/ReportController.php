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

namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Report\Form\Report1Form;
use Report\Form\Report2Form;
use Report\Form\Report5Form;
use Report\Controller\Helper\AuxiliaryControllerHelper;

/**
 * Description of ReportController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class ReportController extends AbstractActionController
{

    /**
     *
     * @var type 
     */
    private $reportManager;

    /**
     *
     * @var type 
     */
    private $sessionContainer;

    /**
     *
     * @var type 
     */
    private $auxiliaryHelper;

    /**
     * 
     * @param type $roleManager
     * @param type $sessionContainer
     */
    public function __construct($entityManager, $sessionContainer)
    {
        $this->reportManager    = $entityManager;
        $this->sessionContainer = $sessionContainer;
        $this->auxiliaryHelper  = new AuxiliaryControllerHelper($entityManager);
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
     * @return boolean
     */
    private function validateAuthentication()
    {
        return true;
    }

    /**
     * 
     */
    public function indexAction()
    {
        
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report1Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report1Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport1Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report1DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student     = $this->params()->fromQuery('si');
        $studentName = $this->params()->fromQuery('sn');
        $lowerValue  = $this->params()->fromQuery('sl');
        $topValue    = $this->params()->fromQuery('st');

        $addressDifferences          = $this->reportManager->getAddressDifferences($student);
        $brothersDifferences         = $this->reportManager->getBrothersDifferences($student);
        $fatherDifferences           = $this->reportManager->getFatherDifferences($student);
        $mateDifferences             = $this->reportManager->getMateDifferences($student);
        $motherDifferences           = $this->reportManager->getMotherDifferences($student);
        $professionalLifeDifferences = $this->reportManager->getProfessionalLifeDifferences($student);
        $socialLifeDifferences       = $this->reportManager->getSocialLifeDifferences($student);
        $studentStatusDifferences    = $this->reportManager->getStudentStatusDifferences($student);

        return new ViewModel([
            'studentId'                   => $student,
            'studentName'                 => $studentName,
            'studentLower'                => $lowerValue,
            'studentHigher'               => $topValue,
            'addressDifferences'          => $addressDifferences,
            'brothersDifferences'         => $brothersDifferences,
            'fatherDifferences'           => $fatherDifferences,
            'mateDifferences'             => $mateDifferences,
            'motherDifferences'           => $motherDifferences,
            'professionalLifeDifferences' => $professionalLifeDifferences,
            'socialLifeDifferences'       => $socialLifeDifferences,
            'studentStatusDifferences'    => $studentStatusDifferences,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report2Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report2Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport2Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report2DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student      = $this->params()->fromQuery('si');
        $studentName  = $this->params()->fromQuery('sn');
        $reportDetail = $this->reportManager->getReport2Detail($student);

        return new ViewModel([
            'studentId'    => $student,
            'studentName'  => $studentName,
            'reportDetail' => $reportDetail,
        ]);
    }
    
    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report5Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report5Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport5Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }
    
    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report5DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student      = $this->params()->fromQuery('si');
        $studentName  = $this->params()->fromQuery('sn');
        $reportDetail = $this->reportManager->getReport5Detail($student);

        return new ViewModel([
            'studentId'    => $student,
            'studentName'  => $studentName,
            'reportDetail' => $reportDetail,
        ]);
    }

}
