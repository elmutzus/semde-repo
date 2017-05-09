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
 * Description of StudentStatusForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentStatusForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('student-status-form');

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
            'name'       => 'semester',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Semestre',
            ],
            'options'    => [
                'label' => 'Semestre',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'repeatedSemesters',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Cantidad',
            ],
            'options'    => [
                'label' => 'Semestre(s) repetido(s)',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'religion',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Religión',
            ],
            'options'    => [
                'label' => 'Religión',
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'professing',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Profesante',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'works',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Labora actualmente',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'jobDescription',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Descripción',
            ],
            'options'    => [
                'label' => 'Descripción de su trabajo',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'highschool',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Nombre del establecimiento',
            ],
            'options'    => [
                'label' => 'Lugar de estudios a nivel medio',
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'livingId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Con quién vive actualmente?',
                'value_options' => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'livesWithOther',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Especifique con quienes vive',
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'economicHelpId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'De quién depende su sostenimiento económico?',
                'value_options' => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'otherEconomicHelp',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Especifique de quién depende',
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'maritalStatusId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Estado civil',
                'value_options' => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'travelTimeId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Cuánto tiempo le lleva trasladarse de su residencia a la USAC?',
                'value_options' => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Radio::class,
            'name'       => 'transportId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Cómo se transporta para llegar a la USAC?',
                'value_options' => [
                ],
            ],
        ]);

        $this->add([
            'type'       => 'submit',
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
            'name'       => 'semester',
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
            'name'       => 'repeatedSemesters',
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
            'name'       => 'religion',
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
                        'max' => 100,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'jobDescription',
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
                        'max' => 500,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'highschool',
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

        $inputFilter->add([
            'name'       => 'livesWithOther',
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
            'name'       => 'otherEconomicHelp',
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
                        'max' => 100,
                    ],
                ],
            ],
        ]);
    }

}
