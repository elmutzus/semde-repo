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

/**
 * Description of Report4Form
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class Report4DetailForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('report4_detail_form');

        // Add form elements
        $this->addElements();
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
            'name'       => 'areaType',
            'attributes' => [
                'class' => 'form-control',
            ],
            'options'    => [
                'label'                     => 'Área para visualizar',
                'disable_inarray_validator' => true,
                'value_options'             => [
                ],
            ],
        ]);
    }

}

