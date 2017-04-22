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

namespace Authentication\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

class LoginForm extends Form
{

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
            'type'       => 'text',
            'name'       => 'user',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Usuario',
            ],
            'options'    => [
                'label' => 'Usuario',
            ],
        ]);

        // Add password field
        $this->add([
            'type'       => 'password',
            'name'       => 'password',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Contraseña',
            ],
            'options'    => [
                'label' => 'Contraseña',
            ],
        ]);

        // Add submit button
        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary btn-block',
                'value' => 'Iniciar sesión',
            ],
            'options'    => [
                'label' => 'Iniciar sesión',
                'id'    => 'submit',
            ],
        ]);
    }

    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        // Add input for "email" field
        $inputFilter->add([
            'name'       => 'user',
            'required'   => true,
            'filters'    => [
                    ['name' => 'StringTrim'],
                    ['name' => 'StripTags'],
                    ['name' => 'StripNewlines'],
            ],
            'validators' => [
                    [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 5,
                        'max' => 25,
                    ],
                ],
            ],
        ]);

        // Add input for "password" field
        $inputFilter->add([
            'name'       => 'password',
            'required'   => true,
            'filters'    => [
                    ['name' => 'StringTrim'],
            ],
            'validators' => [
                    [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 5,
                        'max' => 25,
                    ],
                ],
            ],
        ]);
    }

}
