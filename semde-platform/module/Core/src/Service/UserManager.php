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

namespace Core\Service;

use Core\Entity\User;
use Zend\Crypt\Password\Bcrypt;

/**
 * Description of UserManager
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class UserManager
{

    /**
     * Session manager.
     * @var Zend\Session\SessionContainer
     */
    private $sessionContainer;

    /*
     * Entity manager
     */
    private $entityManager;

    /**
     * Constructs the service.
     */
    public function __construct($sessionContainer, $entityManager)
    {
        $this->sessionContainer = $sessionContainer;
        $this->entityManager    = $entityManager;
    }

    /*
     * Returns the list of all roles for the user
     */

    public function getAll()
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

    public function get($userId)
    {
        $user = $this->entityManager->getRepository(User::class)->findByUser($userId);
        
        if(sizeof($user) == 1)
            return $user[0];

        return null;
    }

    private function getEncriptedPassword($password)
    {
        $bcrypt     = new Bcrypt();
        $securePass = $bcrypt->create($password);

        return $securePass;
    }

    public function create($user)
    {
        // Verify is user id is available
        $existingUser = $this->get($user['user']);

        if ($existingUser)
        {
            throw new \Exception('El usuario no está disponible');
        }

        $model = new User();

        $model->setUser($user['user']);
        $model->setEmail($user['email']);
        $model->setLastName($user['lastname']);
        $model->setName($user['name']);
        $model->setPassword($this->getEncriptedPassword($user['password']));
        $model->setPhone($user['phone']);

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

    public function update($model, $previousPassword)
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

    public function delete($userId)
    {

        $user = $this->get($userId);

        if ($user)
        {
            try
            {
                $this->entityManager->remove($user);
                $this->entityManager->flush();
            }
            catch (Exception $ex)
            {
                throw $ex;
            }
        }
        else
        {
            throw new \Exception('El usuario no se puede eliminar');
        }
    }

}
