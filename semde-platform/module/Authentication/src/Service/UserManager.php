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

namespace Authentication\Service;

use Authentication\Entity\User;
use Zend\Filter\StaticFilter;
use Authentication\Form\LoginForm;

/**
 * Description of UserManager
 *
 * @author manuel
 */
class UserManager
{

    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUsers()
    {
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function getUser($userName)
    {
        $loginForm = new $LoginForm();







        // Create new Post entity.
        $post = new Post();

        $post->setTitle($data['title']);
        $post->setContent($data['content']);
        $post->setStatus($data['status']);
        $currentDate = date('Y-m-d H:i:s');
        $post->setDateCreated($currentDate);

        // Add the entity to entity manager.
        $this->entityManager->persist($post);

        // Add tags to post
        $this->addTagsToPost($data['tags'], $post);

        // Apply changes to database.
        $this->entityManager->flush();
    }

}
