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

namespace Core\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 * Description of UserForm
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class UserForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('user-form');

        // Set POST method
        $this->setAttribute('method', 'post');
        // Set action attribute
        $this->setAttribute('action', '/management/user');

        // Add form elements
        $this->addElements();

        // Add filters
        $this->addInputFilter();
    }

    private function addElements()
    {
        // Add user field
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

        // Add user name field
        $this->add([
            'type'       => 'text',
            'name'       => 'name',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Nombres',
            ],
            'options'    => [
                'label' => 'Nombres',
            ],
        ]);

        // Add user lastname field
        $this->add([
            'type'       => 'text',
            'name'       => 'lastname',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Apellidos',
            ],
            'options'    => [
                'label' => 'Apellidos',
            ],
        ]);

        // Add user email field
        $this->add([
            'type'       => 'text',
            'name'       => 'email',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'usuario@dominio.com',
            ],
            'options'    => [
                'label' => 'Email',
            ],
        ]);

        // Add user phone field
        $this->add([
            'type'       => 'text',
            'name'       => 'phone',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => '22151258',
            ],
            'options'    => [
                'label' => 'Teléfono',
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

        // Add input for "user" field
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
                        'min' => 1,
                        'max' => 50,
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
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        // Add input for "name" field
        $inputFilter->add([
            'name'       => 'name',
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
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        // Add input for "lastname" field
        $inputFilter->add([
            'name'       => 'lastname',
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
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
            ],
        ]);

        // Add input for "email" field
        $inputFilter->add([
            'name'       => 'email',
            'required'   => true,
            'filters'    => [
                ['name' => 'StringTrim'],
            ],
            'validators' => [
                [
                    'name'    => 'EmailAddress',
                    'options' => [
                        'allow'      => \Zend\Validator\Hostname::ALLOW_DNS,
                        'useMxCheck' => false,
                    ],
                ],
            ],
        ]);

        // Add input for "phone" field
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
                        'min' => 1,
                        'max' => 25,
                    ],
                ],
            ],
        ]);
    }

}
