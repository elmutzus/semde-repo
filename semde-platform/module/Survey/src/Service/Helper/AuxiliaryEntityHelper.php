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

use Survey\Entity\EconomicHelpEntity;
use Survey\Entity\LivingEntity;
use Survey\Entity\MaritalStatusEntity;
use Survey\Entity\SocialLifeTypeEntity;
use Survey\Entity\TransportEntity;
use Survey\Entity\TravelTimeEntity;
use Survey\Entity\DepartmentEntity;
use Survey\Entity\TownEntity;
use Survey\Entity\CareerEntity;
use Survey\Entity\RelationshipEntity;

/**
 * Description of AuxiliarEntityHelper
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
    public function getEconomicHelpOptions()
    {
        $allItems = $this->entityManager->getRepository(EconomicHelpEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getLivingOptions()
    {
        $allItems = $this->entityManager->getRepository(LivingEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getMaritalStatusOptions()
    {
        $allItems = $this->entityManager->getRepository(MaritalStatusEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getTravelTimeOptions()
    {
        $allItems = $this->entityManager->getRepository(TravelTimeEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getTransportOptions()
    {
        $allItems = $this->entityManager->getRepository(TransportEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getSocialLifeTypeOptions()
    {
        $allItems = $this->entityManager->getRepository(SocialLifeTypeEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getDepartmentOptions()
    {
        $allItems = $this->entityManager->getRepository(DepartmentEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getName();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getTownOptions($id)
    {

        if (!$id)
        {
            $id = 0;
        }

        $allItems = $this->entityManager->getRepository(TownEntity::class)->findByDepartmentId([
            'departmentId' => $id,
        ]);

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getName();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getCareerOptions()
    {
        $allItems = $this->entityManager->getRepository(CareerEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

    /**
     * 
     * @return type
     */
    public function getRelationshipOptions()
    {
        $allItems = $this->entityManager->getRepository(RelationshipEntity::class)->findAll();

        $options = array();

        if ($allItems != null)
        {
            foreach ($allItems as $item)
            {
                $options[$item->getId()] = $item->getDescription();
            }
        }

        return $options;
    }

}
