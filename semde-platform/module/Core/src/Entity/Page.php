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

namespace Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * 
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 * @ORM\Entity
 * @ORM\Table(name="page")
 */
class Page
{
    /**
     * @ORM\Id
     * @ORM\Column(name="page")   
     */
    protected $page;

    /**
     * @ORM\Column(name="name")   
     */
    protected $name;
    
    /**
     * @ORM\Column(name="description")   
     */
    protected $description;
    
    /**
     * @ORM\Column(name="route")   
     */
    protected $route;
    
    /**
     * @ORM\Column(name="type")   
     */
    protected $type;
    
    /**
     * @ORM\ManyToMany(targetEntity="\Core\Entity\Role", mappedBy="pages")
     */
    protected $roles;
    
    public function __construct()
    {
        $this->roles = new ArrayCollection();
    }
    
    
    public function getPage(){
        return $this->page;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function getDescription(){
        return $this->description;
    }
    
    public function getRoute(){
        return $this->route;
    }
    
    public function getType(){
        return $this->type;
    }
}
