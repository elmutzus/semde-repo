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

namespace Report\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * 
 * @author Elder Mutzus <elmutzus@gmail.com>
 * @ORM\Entity
 * @ORM\Table(name="course")
 */
class CourseEntity
{

    /**
     * @ORM\Id
     * @ORM\Column(name="course")   
     */
    protected $course;
    
    /**
     * @ORM\Id
     * @ORM\Column(name="pensum")   
     */
    protected $pensum;

    /**
     * @ORM\Column(name="name")   
     */
    protected $name;
    
    /**
     * 
     * @return type
     */
    public function getCourse()
    {
        return $this->course;
    }

    /**
     * 
     * @return type
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * 
     * @return type
     */
    public function getPensum()
    {
        return $this->pensum;
    }

}
