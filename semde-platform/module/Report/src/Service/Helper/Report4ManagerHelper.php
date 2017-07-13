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
 * Description of Report4ManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class Report4ManagerHelper
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
        $storedProcedureQuery = 'CALL SP_RPT4_RETRIEVEDATA(:dpi, :nov, :name, :lastname)';

        $statement = $this->entityManager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':dpi', $data['dpi']);
        $statement->bindParam(':nov', $data['nov']);
        $statement->bindParam(':name', $data['name']);
        $statement->bindParam(':lastname', $data['lastname']);

        $statement->execute();

        return $statement->fetchAll();
    }
    
    /**
     * 
     * @param type $student
     * @return type
     */
    public function getDetail($student, $nov){
        $storedProcedureQuery = 'CALL SP_RPT4_RETRIEVEDETAIL(:student, :nov)';

        $statement = $this->entityManager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':student', $student);
        $statement->bindParam(':nov', $nov);

        $statement->execute();

        return $statement->fetchAll();
    }
}
