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

namespace Survey\Service\Helper;

use \DateTime;
use Survey\Entity\StudentStatusEntity;

/**
 * Description of StudentStatusManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentStatusManagerHelper
{

    /**
     *
     * @var type 
     */
    private $entityManager;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * 
     * @param type $id
     */
    public function getStudentStatusById($id)
    {
        $currentTime = new DateTime();
        
        $item = $this->entityManager->getRepository(StudentStatusEntity::class)->find([
            'week' => $currentTime->format('W'),
            'year' => $currentTime->format('Y'),
            'studentId' => $id,
        ]);
        
        return $item;
    }

    /**
     * 
     * @param type $newStudentStatus
     */
    public function addOrUpdateStudentStatus($newStudentStatus)
    {
        
    }

}
