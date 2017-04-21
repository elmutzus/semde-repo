<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
