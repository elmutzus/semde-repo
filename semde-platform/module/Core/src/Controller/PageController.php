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
use Core\Form\PageForm;
use Core\Entity\Page;

/**
 * Description of PageController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class PageController extends AbstractActionController
{
    /*
     * User manager
     */

    private $pageManager;

    /*
     * Session container
     */
    private $sessionContainer;

    /*
     * Constructor
     */

    public function __construct($pageManager, $sessionContainer)
    {
        $this->pageManager      = $pageManager;
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
        $form = new PageForm();

        $this->setLayoutVariables();

        $items = $this->pageManager->getAll();

        return new ViewModel([
            'items' => $items,
        ]);
    }

    public function addAction()
    {
        $form = new PageForm();

        $form->get('submit')->setValue('Crear página');

        $this->setLayoutVariables();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid())
            {
                $this->pageManager->create($form->getData());

                return $this->redirect()->toRoute('pageManagementRoute');
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    public function editAction()
    {
        return new ViewModel([]);
    }

    public function deleteAction()
    {
        $itemId = $this->params()->fromRoute('id', '-');

        if ($itemId == '-')
        {
            return $this->redirect()->toRoute('pageManagementRoute');
        }

        $request = $this->getRequest();

        if ($request->isPost())
        {

            $del = $request->getPost('del', 'No');

            if ($del == 'Yes')
            {
                $itemId = $request->getPost('id');

                //@todo: Verify if the page has roles asigned before deleting it

                $this->pageManager->delete($itemId);
            }

            return $this->redirect()->toRoute('pageManagementRoute');
        }

        return new ViewModel([
            'id' => $itemId,
        ]);
    }
}
