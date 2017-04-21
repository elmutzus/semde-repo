<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Authentication\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Authentication\Service\UserManager;
use Authentication\Controller\AuthenticationController;

/**
 * Description of AuthenticationControllerFactory
 *
 * @author manuel
 */
class AuthenticationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $entityManager = $container->get('doctrine.entitymanager.orm_default');
        $userManager = $container->get(UserManager::class);
        
        // Instantiate the controller and inject dependencies
        return new AuthenticationController($entityManager, $userManager);
    }
}
