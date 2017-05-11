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

namespace Survey\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;
use Zend\Form\Element;

/**
 * Description of AddressForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentAddressForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('student-form');

        // Add form elements
        $this->addElements();

        // Add filters
        $this->addInputFilter();
    }

    private function addElements()
    {
        $this->add([
            'type'       => Element\Hidden::class,
            'name'       => 'week',
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'type'       => Element\Hidden::class,
            'name'       => 'year',
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);

        $this->add([
            'type'       => Element\Hidden::class,
            'name'       => 'studentId',
            'attributes' => [
                'class' => 'form-control',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'zone',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Zona',
            ],
            'options'    => [
                'label' => 'Número de zona',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'anotherSector',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Colonia, barrio, etc.',
            ],
            'options'    => [
                'label' => 'Información adicional',
            ],
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'departmentId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Departamento',
                'disable_inarray_validator' => true,
                'value_options' => [
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'townId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Municipio',
                'disable_inarray_validator' => true,
                'value_options' => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Submit::class,
            'name'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary btn-block',
                'value' => 'Continuar',
            ],
            'options'    => [
                'label' => 'Continuar',
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
            'name'       => 'zone',
            'filters'    => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'digits',
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 2,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'anotherSector',
            'filters'    => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
            ],
        ]);
    }

}
