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

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Authentication\Form\LoginForm;
use Authentication\Form\RoleSelectionForm;
use Zend\Authentication\Result;
use Zend\Session\Container;

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

    /**
     * Auth service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;
    private $sessionContainer;

    public function __construct($entityManager, $authManager, $authService, $sessionContainer)
    {
        $this->entityManager    = $entityManager;
        $this->authManager      = $authManager;
        $this->authService      = $authService;
        $this->sessionContainer = $sessionContainer;
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
        $form = new RoleSelectionForm();

        $layout = $this->layout();
        $layout->setTemplate('layout/semiauthenticated');
        $layout->setVariable('currentUser', $this->sessionContainer->currentUserName);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid())
            {
                // Get filtered and validated data
                $data = $form->getData();

                $result = $this->authManager->getAllRoles($data['user']);
            }
        }
        else
        {
            $currentUser = $this->sessionContainer->currentUser;
            $result      = $this->authManager->getAllRoles();

            $selectElement = 'a';
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * The "logout" action performs logout operation.
     */
    public function logoutAction()
    {
        $this->authManager->logout();

        return $this->redirect()->toRoute('loginRoute');
    }

}
