<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Authentication\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Authentication\Form\AuthenticationForm;

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

    public function performAuthenticationAction()
    {
        if ($this->getRequest()->isPost())
        {
            $form = new AuthenticationForm();

            if ($this->getRequest()->isPost())
            {
                // Fill in the form with POST data
                $data = $this->params()->fromPost();
                $form->setData($data);

                /*// Validate form
                if ($form->isValid())
                {
                    // Get filtered and validated data
                    $data = $form->getData();

                    $layout = $this->layout();
                    $layout->setTemplate('layout/roleSelectionLayout');

                    // Send the data to the view
                    $viewModel = new ViewModel([
                        'userName' => $data['userName'],
                        'userPassword' => $data['userPassword'],
                        'users' => count($this->userManager->getUsers()),
                    ]);

                    $layout->setVariable('currentUser', $data['userName']);

                    return $viewModel;
                }*/
                
                
                
                return new ViewModel();
            }
        }
    }

}
