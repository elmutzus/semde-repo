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

namespace Survey\Service\Helper;

/**
 * Description of ScheduleManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class ScheduleValidatorManagerHelper
{
    /**
     *
     * @var type 
     */
    private $entityManager;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * 
     * @param type $id
     */
    public function validateWeek()
    {
        $storedProcedureQuery = 'CALL SP_SCHEDULE()';

        $statement = $this->entityManager->getConnection()->prepare($storedProcedureQuery);

        $statement->execute();

        $result = $statement->fetchAll();
        
        if(sizeof($result) == 1)
        {
            return (int) $result[0];
        }

        return 0;
    }
}
