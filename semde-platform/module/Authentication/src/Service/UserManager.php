<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Authentication\Service;

use Authentication\Entity\User;
use Zend\Filter\StaticFilter;

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
    
    public function getUsers(){
        return $this->entityManager->getRepository(User::class)->findAll();
    }

    public function getUser($userName)
    {
        /* // Create new Post entity.
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
          $this->entityManager->flush(); */

    }

}
