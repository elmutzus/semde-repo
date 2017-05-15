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
 * Description of StudentSocialLifeForm
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentSocialLifeForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('student_social_life_form');

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
            'type'       => Element\Select::class,
            'name'       => 'socialLifeTypeId',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'                     => 'Cómo califica su vida social?',
                'disable_inarray_validator' => true,
                'value_options'             => [
                ],
            ],
        ]);

        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'socialLifeOther',
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
            'name'       => 'exercises',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Practica algún ejercicio?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'exercisesWhich',
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
            'name'       => 'exercisesFrequency',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Con qué frecuencia?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'drinksAlcohol',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Consume bebidas alcohólicas?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'drinksAlcoholFrequency',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Con qué frecuencia?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'smokes',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Fuma?',
                'value_options' => [
                    '1' => 'Sí',
                    '0' => 'No',
                ],
            ],
        ]);
        
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'smokesFrequency',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Con qué frecuencia?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Select::class,
            'name'       => 'hasChronicDisease',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'         => 'Padece de alguna enfermedad crónica?',
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
                'label'         => 'Padece algún problema de aprendizaje?',
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
            'type'       => Element\Text::class,
            'name'       => 'studyTime',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuánto tiempo dedica al estudio a diario?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'studyMethodology',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Qué metodologías utiliza para sus estudios y tareas?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'sleepHours',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuántas horas durme diariamente?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'familyHours',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuánto tiempo dedica para compartir con su familia?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Textarea::class,
            'name'       => 'familyCommunication',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cómo describe su dinámica familiar?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'friendsHours',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuánto tiempo dedica para compartir con sus amistades?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Number::class,
            'name'       => 'mateHours',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuánto tiempo dedica para estar con su pareja?',
            ],
        ]);
        
        $this->add([
            'type'       => Element\Text::class,
            'name'       => 'anotherActivityTime',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Especifique',
            ],
            'options'    => [
                'label' => 'Cuánto tiempo dedica a otra actividad?',
            ],
        ]);
    }
    
    private function addInputFilter()
    {
        $inputFilter = new InputFilter();
        $this->setInputFilter($inputFilter);

        $inputFilter->add([
            'name'       => 'socialLifeOther',
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
            'name'       => 'exercisesWhich',
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
            'name'       => 'exercisesFrequency',
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
            'name'       => 'drinksAlcoholFrequency',
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
            'name'       => 'smokesFrequency',
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
                        'max' => 200,
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
                        'max' => 200,
                    ],
                ],
            ],
        ]);
        
        $inputFilter->add([
            'name'       => 'studyTime',
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
            'name'       => 'studyMethodology',
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
            'name'       => 'anotherActivityTime',
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
            'name'       => 'familyCommunication',
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
