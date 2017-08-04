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

namespace Report\Service\Helper;

use Report\Entity\CareerEntity;
use Report\Entity\CourseEntity;

/**
 * Description of AuxiliaryEntityHelpder
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class AuxiliaryEntityHelper
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
     * @return type array of key-value pairs
     */
    public function getCareerOptions()
    {
        $allItems = $this->entityManager->getRepository(CareerEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            $options['-1'] = 'Todas';
            
            foreach ($allItems as $item)
            {
                $options[$item->getCareer()] = $item->getName();
            }
        }

        return $options;
    }
    
    /**
     * 
     * @return type array of key-value pairs
     */
    public function getCourseOptions()
    {
        $allItems = $this->entityManager->getRepository(CourseEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            $options['-1'] = 'Todos';
            
            foreach ($allItems as $item)
            {
                $options[$item->getCourse()] = "Pensum " . $item->getPensum() . " - Nombre " . $item->getName();
            }
        }

        return $options;
    }
}
