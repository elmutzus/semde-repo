<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elder.mutzus@inspireswgt.com> - initial API and implementation and/or initial documentation
 */

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Core\Form\LoginForm;
use Core\Form\RoleSelectionForm;
use Zend\Authentication\Result;
use Doctrine\Common\Collections\ArrayCollection;

class AuthenticationController extends AbstractActionController
{

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

    /**
     * Auth manager.
     * @var User\Service\AuthManager 
     */
    private $authManager;

    /*
     * Session container
     */
    private $sessionContainer;

    public function __construct($entityManager, $authManager, $sessionContainer)
    {
        $this->entityManager    = $entityManager;
        $this->authManager      = $authManager;
        $this->sessionContainer = $sessionContainer;
    }

    private function verifySession()
    {
        if (!isset($this->sessionContainer->currentUserId))
        {
            return $this->redirect()->toRoute('loginRoute');
        }
    }

    public function loginAction()
    {
        $isLoginError = false;

        $form = new LoginForm();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid())
            {
                // Get filtered and validated data
                $data = $form->getData();

                $result = $this->authManager->login($data['user'], $data['password'], $data['rememberMe']);

                if ($result->getCode() == Result::SUCCESS)
                {
                    $this->sessionContainer->currentUserId = $result->getIdentity();

                    $userNameResult = $this->authManager->getUserFullName();

                    if (!empty($userNameResult))
                    {
                        $this->sessionContainer->currentUserName = $userNameResult;

                        return $this->redirect()->toRoute('roleSelectionRoute');
                    }
                    else
                    {
                        $isLoginError = true;
                    }
                }
                else
                {
                    $isLoginError = true;
                }
            }
        }

        return new ViewModel([
            'form'         => $form,
            'isLoginError' => $isLoginError,
        ]);
    }

    public function roleSelectionAction()
    {
        $this->verifySession();

        $form = new RoleSelectionForm();

        $layout = $this->layout();
        $layout->setTemplate('layout/semiauthenticated');
        $layout->setVariable('currentUser', $this->sessionContainer->currentUserName);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();
            $form->setData($data);

            if ($form->isValid())
            {
                $this->sessionContainer->currentUserRole   = $this->authManager->getRoleName($data['availableRoles']);
                $this->sessionContainer->currentUserRoleId = $data['availableRoles'];

                return $this->redirect()->toRoute('mainDashboardRoute');
            }
        }
        else
        {
            $currentUser = $this->sessionContainer->currentUserId;
            $result      = $this->authManager->getAllRoles();

            $userField = $form->get('user');
            $userField->setValue($currentUser);

            $selectElement = $form->get('availableRoles');
            $selectElement->setValueOptions($result);
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function mainDashboardAction()
    {
        $this->verifySession();

        $currentRoleId = $this->sessionContainer->currentUserRoleId;

        $layout = $this->layout();
        $layout->setTemplate('layout/authenticated');
        $layout->setVariable('currentUser', $this->sessionContainer->currentUserName);
        $layout->setVariable('currentUserRole', $this->sessionContainer->currentUserRole);

        $pagesPerRole = $this->authManager->getPagesForCurrentRole();
        
        $layout->setVariable('pages', $pagesPerRole);
        
        $managementPages = new ArrayCollection();
        $reportPages = new ArrayCollection();
        
        foreach($pagesPerRole as $page){
            if($page->getType() == 'R'){
                $reportPages[] = $page;
            }
            
            if($page->getType() == 'M'){
                $managementPages[] = $page;
            }
        }
        
        $managementSnippet = '';
        
        foreach($managementPages as $page){
            $managementSnippet .= '<li><a href="<?php= $this->url(\'' . $page->getRoute() . '\') ?>">' . $page->getName() . '</a></li>';
        }
        
        $reportsSnippet = '';
        
        foreach($reportPages as $page){
            $reportsSnippet .= '<li><a href="<?= $this->url(\'' . $page->getRoute() . '\') ?>">' . $page->getName() . '</a></li>';
        }
        
        if(sizeof($reportPages) > 0){
            $layout->setVariable('showReports', true);
            $layout->setVariable('reportsSnippet', $reportsSnippet);
        } else {
            $layout->setVariable('showReports', false);
        }
        
        if(sizeof($managementPages) > 0){
            $layout->setVariable('showManagements', true);
            $layout->setVariable('managementsSnippet', $managementSnippet);
        } else {
            $layout->setVariable('showManagements', false);
        }
    
        return new ViewModel();
    }

    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction()
    {
        $this->sessionContainer->currentUserId     = null;
        $this->sessionContainer->currentUserName   = null;
        $this->sessionContainer->currentUserRole   = null;
        $this->sessionContainer->currentUserRoleId = null;
        $this->authManager->logout();

        return $this->redirect()->toRoute('loginRoute');
    }

}
