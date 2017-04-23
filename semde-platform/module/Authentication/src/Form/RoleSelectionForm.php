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

namespace Authentication\Form;

use Zend\Form\Form;
use Zend\Form\Element;
use Zend\InputFilter\InputFilter;

class RoleSelectionForm extends Form
{

    public function __construct()
    {
        // Define form name
        parent::__construct('role-selection-form');

        // Set POST method
        $this->setAttribute('method', 'post');
        // Set action attribute
        $this->setAttribute('action', '/roleSelection');

        // Add form elements
        $this->addElements();
    }
    
    private function addElements()
    {
        // Add user name field
        $this->add([
            'type'       => 'text',
            'name'       => 'user',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Usuario',
                'disabled' => true,
            ],
            'options'    => [
                'label' => 'Usuario',
            ],
        ]);

        // Add select field
        $this->add([
            'type'       => 'select',
            'name'       => 'availableRoles',
            'attributes' => [
                'class'       => 'form-control',
            ],
            'options'    => [
                'label' => 'Roles disponibles',
            ],
        ]);

        // Add submit button
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
}
