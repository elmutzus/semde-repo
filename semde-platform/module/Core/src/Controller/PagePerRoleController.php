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
use Core\Form\PagePerRoleForm;

/**
 * Description of PagePerRoleController
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class PagePerRoleController extends AbstractActionController
{
    /*
     * Role manager
     */

    private $roleManager;

    /*
     * User manager
     */
    private $pageManager;

    /*
     * Page per role manager
     */
    private $pagePerRoleManager;

    /*
     * Session container
     */
    private $sessionContainer;

    /*
     * Constructor
     */

    public function __construct($pagePerUserManager, $roleManager, $pageManager, $sessionContainer)
    {
        $this->roleManager        = $roleManager;
        $this->pageManager        = $pageManager;
        $this->pagePerRoleManager = $pagePerUserManager;
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
        $this->setLayoutVariables();

        $items = $this->pagePerRoleManager->getAll();

        return new ViewModel([
            'items' => $items,
        ]);
    }
    
    public function deleteAction()
    {
        $this->setLayoutVariables();

        $itemId = $this->params()->fromRoute('id', '-');

        if ($itemId == '-')
        {
            return $this->redirect()->toRoute('pagePerRoleManagementRoute');
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
                    $this->pagePerRoleManager->delete($items[0], $items[1]);
                }
            }

            return $this->redirect()->toRoute('pagePerRoleManagementRoute');
        }

        return new ViewModel([
            'id' => $itemId,
        ]);
    }
}
