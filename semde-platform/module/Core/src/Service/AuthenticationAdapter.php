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

use Zend\Authentication\Adapter\AdapterInterface;
use Zend\Authentication\Result;
use Zend\Crypt\Password\Bcrypt;
use Core\Entity\User;

/**
 * Description of AuthenticationAdapter
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class AuthenticationAdapter implements AdapterInterface
{

    /**
     * User email.
     * @var string 
     */
    private $user;

    /**
     * Password
     * @var string 
     */
    private $password;

    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;

    /**
     * Constructor.
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Sets user.     
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * Sets password.     
     */
    public function setPassword($password)
    {
        $this->password = (string) $password;
    }

    /**
     * Performs an authentication attempt.
     */
    public function authenticate()
    {
        // Check the database if there is a user with such email.
        $user = $this->entityManager->getRepository(User::class)->findOneByUser($this->user);

        // If there is no such user, return 'Identity Not Found' status.
        if ($user == null)
        {
            return new Result(Result::FAILURE_IDENTITY_NOT_FOUND, null, ['Credenciales no válidas']);
        }

        // Now we need to calculate hash based on user-entered password and compare
        // it with the password hash stored in database.
        $bcrypt       = new Bcrypt();
        $passwordHash = $user->getPassword();

        if ($bcrypt->verify($this->password, $passwordHash))
        {
            // Great! The password hash matches. Return user identity (email) to be
            // saved in session for later use.
            return new Result(Result::SUCCESS, $this->user, ['Usuario autenticado']);
        }

        // If password check didn't pass return 'Invalid Credential' failure status.
        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, ['Credenciales inválidas']);
    }
    
}
