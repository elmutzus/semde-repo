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

namespace Report\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;

/**
 * Description of Report1Form
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class Report1Form extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('report1_form');

        // Add form elements
        $this->addElements();
        
        // Add filters
        $this->addInputFilter();
    }
    
    private function addElements()
    {
        $this->add([
            'type'       => Element\Submit::class,
            'name'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary btn-block',
                'value' => 'Generar',
            ],
            'options'    => [
                'label' => 'Generar',
                'id'    => 'submit',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'filterBy',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Filtrar por',
                'value_options' => [
                    'C' => 'Carreras',
                    'S' => 'Estudiantes',
                ],
            ],
        ]);
        
        // Filtering by careers
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'career',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'                     => 'Carrera',
                'disable_inarray_validator' => true,
                'value_options'             => [
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'course',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'                     => 'Curso',
                'disable_inarray_validator' => true,
                'value_options'             => [
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'semester',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Filtrar por',
                'value_options' => [
                    '1' => 'Primer semestre',
                    '2' => 'Segundo semestre',
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'year',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Año',
            ],
            'options'    => [
                'label' => 'Año',
            ],
        ]);
        
        // Filtering by students
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'dpi',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'DPI',
            ],
            'options'    => [
                'label' => 'DPI',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'nov',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Número de Orientación Vocacional',
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
                'placeholder' => 'Nombre',
            ],
            'options'    => [
                'label' => 'Nombre',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'lastname',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Apellido',
            ],
            'options'    => [
                'label' => 'Apellido',
            ],
        ]);
    }
    
    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'       => 'year',
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
                        'min' => 0,
                        'max' => 4,
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
                        'min' => 0,
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
                        'min' => 0,
                        'max' => 10,
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
                        'min' => 0,
                        'max' => 100,
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
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
            ],
        ]);
    }
}
