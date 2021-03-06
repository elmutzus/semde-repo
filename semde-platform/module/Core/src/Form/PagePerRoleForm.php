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

use Zend\Form\Element;
use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 * Description of PagePerRoleForm
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class PagePerRoleForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('page-per-role-form');
        
        // Set POST method
        $this->setAttribute('method', 'post');

        // Add form elements
        $this->addElements();

        // Add filters
        $this->addInputFilter();
    }
    
    private function addElements()
    {
        // Add type field
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'role',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Rol',
                'disable_inarray_validator' => true,
            ],
        ]);
        
        // Add type field
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'page',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Página',
                'disable_inarray_validator' => true,
            ],
        ]);

        // Add description field
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
                        'max' => 200,
                    ],
                ],
            ],
        ]);
    }
}
