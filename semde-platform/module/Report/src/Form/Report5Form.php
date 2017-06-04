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
 * Description of Report5Form
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class Report5Form extends Form
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
            'name'       => 'career',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'                     => 'Carrera',
                'disable_inarray_validator' => true,
                'value_options'             => [
                    '0' => 'Hola',
                    '1' => 'Hi',
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
                    '-1' => 'Todos',
                    '1'  => 'Primer semestre',
                    '2'  => 'Segundo semestre',
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
    }

    private function addInputFilter()
    {
        // Create main input filter
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'       => 'year',
            'required'   => false,
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 4,
                        'max' => 4,
                    ],
                ],
            ],
        ]);
    }

}
