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

    /**
     * User manager.
     * @var User\Service\UserManager
     */
    private $userManager;

    public function __construct($entityManager, $authManager, $authService, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->authManager   = $authManager;
        $this->authService   = $authService;
        $this->userManager   = $userManager;
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

                if ($data['user'] == 'manuelito')
                {
                    return $this->redirect()->toRoute('roleSelectionRoute');
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
        $Iamhere = true;
    }

}
