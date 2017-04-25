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

namespace Core\Service;

use Core\Entity\User;
use Zend\Crypt\Password\Bcrypt;

/**
 * Description of UserManager
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class UserManager
{

    /**
     * Authentication service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;

    /**
     * Session manager.
     * @var Zend\Session\SessionContainer
     */
    private $sessionContainer;

    /**
     * Contents of the 'access_filter' config key.
     * @var array 
     */
    private $config;
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($sessionContainer, $config, $entityManager)
    {
        $this->sessionContainer = $sessionContainer;
        $this->config           = $config;
        $this->entityManager    = $entityManager;
    }

    /*
     * Returns the list of all roles for the user
     */

    public function getAllUsers()
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();

        $usersToReturn = array();

        foreach ($users as $user)
        {
            $usersToReturn[] = [
                'user'     => $user->getUser(),
                'name'     => $user->getName(),
                'lastname' => $user->getLastName(),
                'email'    => $user->getEmail(),
                'phone'    => $user->getPhone(),
            ];
        }

        return $usersToReturn;
    }

    public function getUser($userId)
    {
        $user = $this->entityManager->getRepository(User::class)->findByUser($userId);

        return $user;
    }

    private function getEncriptedPassword($password)
    {
        $bcrypt     = new Bcrypt();
        $securePass = $bcrypt->create($password);

        return $securePass;
    }

    public function createUser($user, $password, $name, $lastname, $email, $phone)
    {
        // Verify is user id is available
        $existingUser = $this->getUser($user);

        if ($existingUser)
        {
            throw new \Exception('El usuario no está disponible');
        }

        $model = new User();

        $model->setUser($user);
        $model->setEmail($email);
        $model->setLastName($lastname);
        $model->setName($name);
        $model->setPassword($this->getEncriptedPassword($password));
        $model->setPhone($phone);

        try
        {
            $this->entityManager->persist($model);
            $this->entityManager->flush();
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }

    public function updateUser($model, $previousPassword)
    {
        $updatedUser = new User();
        $updatedUser->setUser($model['user']);
        $updatedUser->setName($model['name']);
        $updatedUser->setLastName($model['lastname']);
        $updatedUser->setEmail($model['email']);
        $updatedUser->setPhone($model['phone']);        

        if ($model['password'])
        {
            $updatedUser->setPassword($this->getEncriptedPassword($model['password']));
        }
        else
        {
            $updatedUser->setPassword($previousPassword);
        }

        try
        {
            $this->entityManager->merge($updatedUser);
            $this->entityManager->flush();
        }
        catch (Exception $ex)
        {
            throw $ex;
        }
    }

}