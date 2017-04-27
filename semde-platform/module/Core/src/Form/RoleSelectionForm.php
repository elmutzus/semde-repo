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

namespace Core\Form;

use Zend\Form\Form;
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
            'name'       => 'id',
            'attributes' => [
                'class'       => 'form-control',
                'disabled'    => true,
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
                'class' => 'form-control',
            ],
            'options'    => [
                'label'   => 'Roles disponibles',
                'disable_inarray_validator' => true,
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
