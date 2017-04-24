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

namespace Core\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;

/**
 * Description of RoleForm
 *
 * @author Elder Mutzus <elder.mutzus@inspireswgt.com>
 */
class RoleForm extends Form
{
    public function __construct()
    {
        // Define form name
        parent::__construct('role-form');

        // Set POST method
        $this->setAttribute('method', 'post');
        // Set action attribute
        $this->setAttribute('action', '/login');

        // Add form elements
        $this->addElements();

        // Add filters
        $this->addInputFilter();
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
            ],
            'options'    => [
                'label' => 'Usuario',
            ],
        ]);

        // Add password field
        $this->add([
            'type'       => 'password',
            'name'       => 'password',
            'attributes' => [
                'class'       => 'form-control',
                'placeholder' => 'Contraseña',
            ],
            'options'    => [
                'label' => 'Contraseña',
            ],
        ]);

        // Add "remember me" field
        $this->add([
            'type'       => 'checkbox',
            'name'       => 'rememberMe',
              'options'    => [
                'label' => 'Recordarme',
            ],
        ]);

        // Add submit button
        $this->add([
            'type'       => 'submit',
            'name'       => 'submit',
            'attributes' => [
                'class' => 'btn btn-primary btn-block',
                'value' => 'Iniciar sesión',
            ],
            'options'    => [
                'label' => 'Iniciar sesión',
                'id'    => 'submit',
            ],
        ]);
    }
}
