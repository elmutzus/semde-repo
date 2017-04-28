<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elder.mutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elmutzus@gmail.com> - initial API and implementation and/or initial documentation
 */

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Core\Form\RoleForm;
use Core\Entity\Role;

/**
 * Description of UserController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RoleController extends AbstractActionController
{
    /*
     * User manager
     */

    private $roleManager;

    /*
     * Session container
     */
    private $sessionContainer;

    /*
     * Constructor
     */

    public function __construct($roleManager, $sessionContainer)
    {
        $this->roleManager      = $roleManager;
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
        $form = new RoleForm();

        $this->setLayoutVariables();

        $items = $this->roleManager->getAll();

        return new ViewModel([
            'items' => $items,
        ]);
    }

    public function addAction()
    {
        $form = new RoleForm();

        $form->get('submit')->setValue('Crear rol');

        $this->setLayoutVariables();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid())
            {
                $this->roleManager->create($form->getData());

                return $this->redirect()->toRoute('roleManagementRoute');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function modifyAction()
    {
        $this->setLayoutVariables();

        $itemId = $this->params()->fromRoute('id', '-');

        if ($itemId == '-')
        {
            return $this->redirect()->toRoute('roleManagementRoute', ['action' => 'index']);
        }

        $existingItem = $this->roleManager->get($itemId);

        if (!$existingItem)
        {
            throw new \Exception("No se puede encontrar el rol");
        }

        $form = new RoleForm();

        $form->get('submit')->setValue('Modificar rol');
        $form->get('id')->setAttribute('readonly', 'true');

        $form->get('id')->setValue($existingItem->getId());
        $form->get('description')->setValue($existingItem->getDescription());

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

        $this->roleManager->update($form->getData());

        return $this->redirect()->toRoute('roleManagementRoute');
    }

    public function deleteAction()
    {
        $itemId = $this->params()->fromRoute('id', '-');

        if ($itemId == '-')
        {
            return $this->redirect()->toRoute('roleManagementRoute');
        }

        $request = $this->getRequest();

        if ($request->isPost())
        {

            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $itemId = $request->getPost('id');

                //@todo: Verify if the role has users asigned before deleting it

                $this->roleManager->delete($itemId);
            }

            return $this->redirect()->toRoute('roleManagementRoute');
        }

        return new ViewModel([
            'id' => $itemId,
        ]);
    }

}
