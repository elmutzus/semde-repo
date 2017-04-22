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

    private $entityManager;
    private $userManager;

    public function __construct($entityManager, $userManager)
    {
        $this->entityManager = $entityManager;
        $this->userManager = $userManager;
    }

    public function indexAction()
    {
        return [];
    }

    public function loginAction()
    {
        if ($this->getRequest()->isPost())
        {
            $form = new LoginForm();

            if ($this->getRequest()->isPost())
            {
                // Fill in the form with POST data
                $data = $this->params()->fromPost();
                $form->setData($data);

                // Validate form
                if ($form->isValid())
                {
                    // Get filtered and validated data
                    $data = $form->getData();
                    
                    if($data['userName'] == 'manuelito'){
                        return $this->redirect()->toRoute('home');
                    } else {
                        return $this->redirect()->toRoute('loginRoute');
                    }
                }
            }

            return new ViewModel([
                'form' => $form,
                'error' => 'Usuario no encontrado.'
            ]);
        }
    }

}
