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
 * Description of StudentBrotherForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentBrotherForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('student_brother_form');

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
                'value' => 'Continuar',
            ],
            'options'    => [
                'label' => 'Continuar',
                'id'    => 'submit',
            ],
        ]);

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
            'name'       => 'quantity',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuántos hermanos(as) tiene?',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'place',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Qué lugar ocupa usted entre sus hermanos(as)?',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'academicTitle',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Títulos académicos',
            ],
        ]);

        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'communication',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Tipo de comunicación entre ellos y usted',
            ],
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'hasChronicDisease',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Alguno de ellos(as) padece(n) de alguna enfermedad crónica?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'chronicDisease',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuál?',
            ],
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'hasLearningIllness',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Alguno de ellos(as) padece(n) de algún problema de aprendizaje?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'learningIllness',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuál?',
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
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'       => 'quantity',
            'filters'    => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name' => 'digits',
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'place',
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
            'name'       => 'academicTitle',
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
            'name'       => 'communication',
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
            'name'       => 'chronicDisease',
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
            'name'       => 'learningIllness',
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
    }

}
