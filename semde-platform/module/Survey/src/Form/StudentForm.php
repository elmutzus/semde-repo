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
 * Description of StudentForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('student_form');

        // Add form elements
        $this->addElements();

        // Add filters
        $this->addInputFilter();
    }

    private function addElements()
    {
        // Add user name field
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'id',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Número de carnet',
            ],
            'options'    => [
                'label' => 'Número de carnet',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'dpi',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Número',
            ],
            'options'    => [
                'label' => 'C.U.I.',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'nov',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Número',
            ],
            'options'    => [
                'label' => 'Número de Orientación Vocacional',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'name',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Nombres',
            ],
            'options'    => [
                'label' => 'Nombres',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'lastname',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Apellidos',
            ],
            'options'    => [
                'label' => 'Apellidos',
            ],
        ]);

        $this->add([
            'type' => Element\Hidden::class,
            'name' => 'hiddenGender',
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'gender',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Género',
                'value_options' => [
                    'F' => 'Femenino',
                    'M' => 'Masculino',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Date::class,
            'name'       => 'birthdate',
            'options'    => [
                'label'  => 'Fecha de nacimiento (año-mes-dia)',
                'format' => 'Y-m-d',
                'locale' => 'es',
            ],
            'attributes' => [
                'min'  => '1950-01-01',
                'max'  => '2050-01-01',
                'step' => '1', // days; default step interval is 1 day
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'birthplace',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Lugar de nacimiento',
            ],
            'options'    => [
                'label' => 'Lugar de nacimiento',
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

        $this->add([
            'type'       => Element\Checkbox::class,
            'name'       => 'acceptTerms',
            'options'    => [
                'label'              => 'Label',
                'use_hidden_element' => true,
                'checked_value'      => 'yes',
                'unchecked_value'    => 'no',
            ],
            'attributes' => [
                'value' => 'yes',
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
                    'name' => 'digits',
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 9,
                        'max' => 9,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'dpi',
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
                        'min' => 13,
                        'max' => 13,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'nov',
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
                        'max' => 15,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'name',
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

        $inputFilter->add([
            'name'       => 'lastname',
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

        $inputFilter->add([
            'name'       => 'birthplace',
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
                        'max' => 300,
                    ],
                ],
            ],
        ]);
    }

}
