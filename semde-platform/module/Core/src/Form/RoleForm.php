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

namespace Core\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 * Description of RoleForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class RoleForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('role-form');

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
            'name'       => 'id',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'ID',
            ],
            'options'    => [
                'label' => 'ID',
            ],
        ]);

        // Add password field
        $this->add([
            'type'       => 'text',
            'name'       => 'description',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Descripción',
            ],
            'options'    => [
                'label' => 'Descripción',
            ],
        ]);

        // Add submit button
        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary btn-block',
                'value' => 'Enviar',
            ],
            'options'    => [
                'label' => 'Enviar',
                'id'    => 'submit',
            ],
        ]);
    }
    
    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'       => 'id',
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
                [
                    'name'    => 'Regex',
                    'options' => [
                        'pattern'  => '/^[\w]*$/',
                        'messages' => [
                            'regexNotMatch' => 'El rol no es válido. No usar símbolos especiales',
                        ],
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'description',
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
    }
}
