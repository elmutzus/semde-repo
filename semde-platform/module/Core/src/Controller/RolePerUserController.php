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

namespace Core\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Core\Form\RolePerUserForm;

/**
 * Description of RolePerUserController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RolePerUserController extends AbstractActionController
{
    /*
     * Role manager
     */

    private $roleManager;

    /*
     * User manager
     */
    private $userManager;

    /*
     * Role per user manager
     */
    private $rolePerUserManager;

    /*
     * Session container
     */
    private $sessionContainer;

    /*
     * Constructor
     */

    public function __construct($rolePerUserManager, $roleManager, $userManager, $sessionContainer)
    {
        $this->roleManager        = $roleManager;
        $this->userManager        = $userManager;
        $this->rolePerUserManager = $rolePerUserManager;
        $this->sessionContainer   = $sessionContainer;
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
        $form = new RolePerUserForm();

        $this->setLayoutVariables();

        $items = $this->rolePerUserManager->getAll();

        return new ViewModel([
            'items' => $items,
        ]);
    }

    public function addAction()
    {
        
    }

    public function deleteAction()
    {
        $itemId = $this->params()->fromRoute('id', '-');

        if ($itemId == '-')
        {
            return $this->redirect()->toRoute('rolePerUserManagementRoute');
        }

        $request = $this->getRequest();

        if ($request->isPost())
        {

            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $itemId = $request->getPost('id');

                $items = split('-', $itemId);

                if (sizeof($items) == 2)
                {
                    $this->rolePerUserManager->delete($items[0], $items[1]);
                }
            }

            return $this->redirect()->toRoute('rolePerUserManagementRoute');
        }

        return new ViewModel([
            'id' => $itemId,
        ]);
    }

}
