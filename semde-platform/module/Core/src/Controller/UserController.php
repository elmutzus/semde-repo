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

/**
 * Description of UserController
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class UserController extends AbstractActionController
{

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

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

    public function __construct($entityManager, $userManager, $sessionContainer)
    {
        $this->entityManager    = $entityManager;
        $this->userManager      = $userManager;
        $this->sessionContainer = $sessionContainer;
    }

    public function indexAction()
    {
        $form = new UserForm();
        
        $layout = $this->layout();
        $layout->setTemplate('layout/authenticated');

        return new ViewModel();
    }

    public function addAction()
    {
        $form = new UserForm();
        
        $layout = $this->layout();
        $layout->setTemplate('layout/authenticated');

        return new ViewModel();
    }

}
