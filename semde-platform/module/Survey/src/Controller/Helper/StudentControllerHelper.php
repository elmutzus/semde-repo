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

namespace Survey\Controller\Helper;

/**
 * Description of StudentHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class StudentControllerHelper
{
    public function fillFormData($form, $existingData, $idStudent)
    {
        $form->get('id')->setValue($idStudent);
        
        if ($existingData == null)
        {
            return $form;
        }
        
        $form->get('dpi')->setValue($existingData->getDpi());
        $form->get('nov')->setValue($existingData->getNov());
        $form->get('name')->setValue($existingData->getName());
        $form->get('lastname')->setValue($existingData->getLastname());
        $form->get('gender')->setValue($existingData->getGender());
        $form->get('birthdate')->setValue($existingData->getBirthdate());

        $form->get('id')->setAttribute('readonly', 'true');

        if ($existingData->getDpi() != '')
        {
            $form->get('dpi')->setAttribute('readonly', 'true');
        }

        if ($existingData->getNov() != '')
        {
            $form->get('nov')->setAttribute('readonly', 'true');
        }

        if ($existingData->getName() != '')
        {
            $form->get('name')->setAttribute('readonly', 'true');
        }

        if ($existingData->getLastname() != '')
        {
            $form->get('lastname')->setAttribute('readonly', 'true');
        }

        if ($existingData->getGender() != '')
        {
            $form->get('gender')->setAttribute('disabled', 'true');
            $form->get('hiddenGender')->setValue($existingData->getGender());
        }

        if ($existingData->getBirthdate() != '')
        {
            $form->get('birthdate')->setAttribute('readonly', 'true');
        }

        return $form;
    }
}
