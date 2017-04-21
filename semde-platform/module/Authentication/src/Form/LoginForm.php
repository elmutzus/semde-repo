<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Authentication\Form;

use Zend\Form\Form;

/**
 * Description of LoginForm
 *
 * @author manuel
 */
class LoginForm extends Form
{

    //put your code here

    public function __construct()
    {
        // Define form name
        parent::__construct('login-form');

        // Set POST method
        $this->setAttribute('method', 'post');
        // Set action attribute
        $this->setAttribute('action', '/login');

        // Add form elements
        $this->addElements();
    }

    private function addElements()
    {

        // Add user name field
        $this->add([
            'type' => 'text',
            'name' => 'userName',
            'attributes' => [
                'id' => 'userName',
                'class' => 'form-control',
                'placeholder' => 'Usuario',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Usuario',
            ],
        ]);

        // Add password field
        $this->add([
            'type' => 'password',
            'name' => 'userPassword',
            'attributes' => [
                'id' => 'userPassword',
                'class' => 'form-control',
                'placeholder' => 'Contraseña',
                'required' => 'true',
            ],
            'options' => [
                'label' => 'Contraseña',
            ],
        ]);

        // Add submit button
        $this->add([
            'type' => 'submit',
            'name' => 'sendAuthenticationInformation',
            'attributes' => [
                'id' => 'sendAuthenticationInformation',
                'class' => 'btn btn-primary btn-block',
                'value' => 'Iniciar sesión',
            ],
            'options' => [
                'label' => 'Iniciar sesión',
            ],
        ]);
    }

}

