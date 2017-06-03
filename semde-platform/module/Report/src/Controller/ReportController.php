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
use Report\Controller\Helper\Report1ControllerHelper;

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
    private $report1Helper;

    /**
     * 
     * @param type $roleManager
     * @param type $sessionContainer
     */
    public function __construct($entityManager, $sessionContainer)
    {
        $this->reportManager    = $entityManager;
        $this->sessionContainer = $sessionContainer;
        $this->report1Helper    = new Report1ControllerHelper($entityManager);
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

    private function validateAuthentication()
    {
        return true;
    }

    public function indexAction()
    {
        
    }

    public function report1Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report1Form();

        $form = $this->report1Helper->fillOptionsData($form);

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

    public function report1DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');
        
        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }
        
        $student = $this->params()->fromQuery('studentId');
        $studentName = $this->params()->fromQuery('studentName');
        
        $addressDifferences = $this->reportManager->getAddressDifferences($student);
        $brothersDifferences = $this->reportManager->getBrothersDifferences($student);
        $fatherDifferences = $this->reportManager->getFatherDifferences($student);
        $mateDifferences = $this->reportManager->getMateDifferences($student);
        $motherDifferences = $this->reportManager->getMotherDifferences($student);
        $professionalLifeDifferences = $this->reportManager->getProfessionalLifeDifferences($student);
        $socialLifeDifferences = $this->reportManager->getSocialLifeDifferences($student);
        $studentStatusDifferences = $this->reportManager->getStudentStatusDifferences($student);

        return new ViewModel([
            'studentId' => $student,
            'studentName' => $studentName,
            'addressDifferences' => $addressDifferences,
            'brothersDifferences' => $brothersDifferences,
            'fatherDifferences'=>$fatherDifferences,
            'mateDifferences'=>$mateDifferences,
            'motherDifferences'=>$motherDifferences,
            'professionalLifeDifferences'=>$professionalLifeDifferences,
            'socialLifeDifferences'=>$socialLifeDifferences,
            'studentStatusDifferences'=>$studentStatusDifferences,
        ]);
    }

}
