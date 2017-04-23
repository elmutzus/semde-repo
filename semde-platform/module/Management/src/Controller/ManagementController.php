<?php

/*
 * Copyright (c) 2017 Elder Mutzus <elmutzus@inspireswgt.com>.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the Eclipse Public License v1.0
 * which accompanies this distribution, and is available at
 * http://www.eclipse.org/legal/epl-v10.html
 *
 * Contributors:
 *    Elder Mutzus <elder.mutzus@inspireswgt.com> - initial API and implementation and/or initial documentation
 */

namespace Management\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ManagementController extends AbstractActionController
{

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

    private $sessionContainer;

    public function __construct($entityManager, $sessionContainer)
    {
        $this->entityManager    = $entityManager;
        $this->sessionContainer = $sessionContainer;
    }

    private function verifySession()
    {
        if (!isset($this->sessionContainer->currentUserId))
        {
            return $this->redirect()->toRoute('userManagementRoute');
        }
    }
}
