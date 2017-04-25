<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elder.mutzus@inspireswgt.com>.
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
use Core\Form\UserForm;
use Core\Entity\User;

/**
 * Description of UserController
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class UserController extends AbstractActionController
{
    /*
     * User manager
     */

    private $userManager;

    /*
     * Session container
     */
    private $sessionContainer;

    /*
     * Constructor
     */

    public function __construct($userManager, $sessionContainer)
    {
        $this->userManager      = $userManager;
        $this->sessionContainer = $sessionContainer;
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

    public function indexAction()
    {
        $form = new UserForm();

        $this->setLayoutVariables();

        $users = $this->userManager->getAllUsers();

        return new ViewModel([
            'users' => $users,
        ]);
    }

    public function addAction()
    {
        $form = new UserForm();

        $form->get('submit')->setValue('Crear usuario');

        $this->setLayoutVariables();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid())
            {
                $this->userManager->create($form->getData());

                return $this->redirect()->toRoute('userManagementRoute');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function modifyAction()
    {
        $this->setLayoutVariables();

        $userId = $this->params()->fromRoute('user', '-');

        if ($userId == '-')
        {
            return $this->redirect()->toRoute('userManagement', ['action' => 'index']);
        }

        $user = $this->userManager->getUser($userId);

        if (!$user)
        {
            throw new \Exception("No se puede encontrar el usuario");
        }

        $form = new UserForm();

        $form->get('submit')->setValue('Modificar usuario');
        $form->get('user')->setAttribute('readonly', 'true');
        $form->getInputFilter()->get('password')->setRequired(false);

        $form->get('user')->setValue($user->getUser());
        $form->get('name')->setValue($user->getName());
        $form->get('lastname')->setValue($user->getLastName());
        $form->get('email')->setValue($user->getEmail());
        $form->get('phone')->setValue($user->getPhone());

        if (!$this->request->isPost())
        {
            return new ViewModel([
                'form' => $form,
            ]);
        }

        $form->setData($this->request->getPost());

        if (!$form->isValid())
        {
            return new ViewModel([
                'form' => $form,
            ]);
        }

        $this->userManager->update($form->getData(), $user->getPassword());

        return $this->redirect()->toRoute('userManagementRoute');
    }

    public function deleteAction()
    {
        $userId = $this->params()->fromRoute('user', '-');

        if ($userId == '-')
        {
            return $this->redirect()->toRoute('userManagementRoute');
        }

        $request = $this->getRequest();

        if ($request->isPost())
        {

            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $userId = $request->getPost('user');

                $this->userManager->delete($userId);
            }

            return $this->redirect()->toRoute('userManagementRoute');
        }

        return new ViewModel([
            'user' => $userId,
        ]);
    }

}
