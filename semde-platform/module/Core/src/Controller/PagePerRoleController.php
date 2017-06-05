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
use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;

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

        $items      = $this->pagePerRoleManager->getAll();
        $collection = new \Doctrine\Common\Collections\ArrayCollection($items);
        $paginator  = new \Zend\Paginator\Paginator(new \DoctrineModule\Paginator\Adapter\Collection($collection));
        $paginator->setDefaultItemCountPerPage(10);

        $page = (int) $this->params()->fromQuery('page');

        if ($page)
        {
            $paginator->setCurrentPageNumber($page);
        }

        return new ViewModel([
            'items' => $paginator,
        ]);
    }

    public function addAction()
    {
        $form = new PagePerRoleForm();

        $form->get('submit')->setValue('Asignar página a rol');

        $this->setLayoutVariables();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            // Validate form
            if ($form->isValid())
            {
                $this->pagePerRoleManager->create($form->getData());

                return $this->redirect()->toRoute('pagePerRoleManagementRoute');
            }
        }

        $allPages    = $this->pageManager->getAll();
        $pageOptions = array();

        foreach ($allPages as $page)
        {
            $pageOptions[$page['id']] = $page['id'] . ' - ' . $page['description'];
        }

        $userSelect = $form->get('page');
        $userSelect->setValueOptions($pageOptions);

        $allRoles    = $this->roleManager->getAll();
        $roleOptions = array();

        foreach ($allRoles as $role)
        {
            $roleOptions[$role['id']] = $role['id'] . ' - ' . $role['description'];
        }

        $roleSelect = $form->get('role');
        $roleSelect->setValueOptions($roleOptions);

        return new ViewModel([
            'form' => $form,
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
