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

namespace Report\Service\Helper;

/**
 * Description of Report2ManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class Report2ManagerHelper
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
     * @param type $form
     */
    public function getQueryData($data)
    {
        $storedProcedureQuery = 'CALL SP_RPT2_RETRIEVEDATA(:filterBy, :career, :course, :year, :semester, :dpi, :nov, :name, :lastname)';

        $statement = $this->entityManager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':filterBy', $data['filterBy']);
        $statement->bindParam(':career', $data['career']);
        $statement->bindParam(':course', $data['course']);
        $statement->bindParam(':year', $data['year']);
        $statement->bindParam(':semester', $data['semester']);
        $statement->bindParam(':dpi', $data['dpi']);
        $statement->bindParam(':nov', $data['nov']);
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':lastname', $data['lastname']);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
}
