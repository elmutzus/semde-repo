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

namespace Survey\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @author Elder Mutzus <elmutzus@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="social_life_type")
 */
class SocialLifeTypeEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id")   
     */
    protected $id;

    /**
     * @ORM\Column(name="description")   
     */
    protected $description;

    /**
     * Gets the ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the description
     */
    public function getDescription()
    {
        return $this->description;
    }

}
