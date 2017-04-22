<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Authentication\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

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

        // Add filters
        $this->addInputFilter();
    }

    private function addElements()
    {

        // Add user name field
        $this->add([
            'type' => 'text',
            'name' => 'user',
            'attributes' => [
                'id' => 'user',
                'class' => 'form-control',
                'placeholder' => 'Usuario',
            ],
            'options' => [
                'label' => 'Usuario',
            ],
        ]);

        // Add password field
        $this->add([
            'type' => 'password',
            'name' => 'password',
            'attributes' => [
                'id' => 'password',
                'class' => 'form-control',
                'placeholder' => 'Contraseña',
            ],
            'options' => [
                'label' => 'Contraseña',
            ],
        ]);

        // Add submit button
        $this->add([
            'type' => 'submit',
            'name' => 'submit',
            'attributes' => [
                'id' => 'submit',
                'class' => 'btn btn-primary btn-block',
                'value' => 'Iniciar sesión',
            ],
            'options' => [
                'label' => 'Iniciar sesión',
            ],
        ]);
    }

    /**
     * This method creates input filter (used for form filtering/validation).
     */
    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        // Add input for "email" field
        $inputFilter->add([
            'name' => 'user',
            'required' => true,
            'filters' => [
                    ['name' => 'StringTrim'],
            ],
            'validators' => [
                    [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 5,
                        'max' => 25,
                    ],
                ],
            ],
        ]);

        // Add input for "password" field
        $inputFilter->add([
            'name' => 'password',
            'required' => true,
            'filters' => [
            ],
            'validators' => [
                    [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 5,
                        'max' => 25,
                    ],
                ],
            ],
        ]);

    }

}
