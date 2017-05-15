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
 * Description of StudentProfessionalLifeForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentProfessionalLifeForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('student_professional_life_form');

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
            'type'       => Element\Select::class,
            'name'       => 'hasScholarship',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Cuenta con algún tipo de beca en la USAC para mantener sus estudios?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'scholarship',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Especifique',
            ],
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'studiesLanguages',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Cursa algún otro idioma o lengua?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'studiesWhichLanguages',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuál(es)?',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'studiesLanguagesPercentage',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'En qué porcentaje lo(s) domina?',
            ],
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'handlesLanguages',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Maneja algún otro idioma o lengua?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'handlesWhichLanguages',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuál(es)?',
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'handlesLanguagesPercentage',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'En qué porcentaje lo(s) domina?',
            ],
        ]);

        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'careerId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'                     => 'Carrera a seguir',
                'disable_inarray_validator' => true,
                'value_options'             => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'careerMotivation',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Qué le motivó a seguir esta carrera?',
            ],
        ]);

        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'hobbies',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Qué pasatiempos o actividades lúdicas practica?',
            ],
        ]);

        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'selfDescription',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cómo se describe a usted mismo?',
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

        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'       => 'scholarship',
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
            'name'       => 'studiesLanguagesPercentage',
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
                    'name'    => 'between',
                    'options' => [
                        'min'       => 0,
                        'max'       => 100,
                        'inclusive' => true,
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 3,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'studiesWhichLanguages',
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
            'name'       => 'handlesLanguagesPercentage',
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
                    'name'    => 'between',
                    'options' => [
                        'min'       => 0,
                        'max'       => 100,
                        'inclusive' => true,
                    ],
                ],
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 3,
                    ],
                ],
            ],
        ]);

        

        $inputFilter->add([
            'name'       => 'handlesWhichLanguages',
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
            'name'       => 'careerMotivation',
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
                        'max' => 250,
                    ],
                ],
            ],
        ]);

        $inputFilter->add([
            'name'       => 'hobbies',
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
            'name'       => 'selfDescription',
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
