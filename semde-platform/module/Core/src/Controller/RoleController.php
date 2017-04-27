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
        return new ViewModel([]);
    }

    public function modifyAction()
    {
        return new ViewModel([]);
    }

    public function deleteAction()
    {
        return new ViewModel([]);
    }

}
