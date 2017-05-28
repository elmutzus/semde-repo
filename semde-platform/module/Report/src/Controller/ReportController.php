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

namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 * Description of ReportController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class ReportController extends AbstractActionController
{
    /**
     *
     * @var type 
     */
    private $reportManager;

    /**
     *
     * @var type 
     */
    private $sessionContainer;
    
    /**
     * 
     * @param type $roleManager
     * @param type $sessionContainer
     */
    public function __construct($roleManager, $sessionContainer)
    {
        $this->reportManager                   = $roleManager;
        $this->sessionContainer                = $sessionContainer;
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

    private function validateAuthentication($id, $idSecret)
    {
        if ($id != '-')
        {
            return true;
        }
    }

    public function indexAction()
    {
        
    }
}
