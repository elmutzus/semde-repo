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
 * Description of Report1ManagerHelper
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class Report1ManagerHelper
{

    /**
     *
     * @var type 
     */
    private $entityManager;
    
    /**
     *
     * @var type 
     */
    private $surveyEntitymanager;

    /**
     * 
     * @param type $entityManager
     */
    public function __construct($entityManager, $surveyEntityManager)
    {
        $this->entityManager = $entityManager;
        $this->surveyEntitymanager = $surveyEntityManager;
    }

    /**
     * 
     * @param type $form
     */
    public function getQueryData($data)
    {
        $storedProcedureQuery = 'CALL SP_RPT1_RETRIEVEDATA(:filterBy, :career, :course, :year, :semester, :dpi, :nov, :name, :lastname)';

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

    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getAddressDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_ADDRESS(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getBrothersDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_BROTHERS(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getFatherDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_FATHER(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getMateDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_MATE(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getMotherDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_MOTHER(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getProfessionalLifeDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_PROFESSIONAL_LIFE(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getSocialLifeDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_SOCIAL_LIFE(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }
    
    /**
     * 
     * @param type $studentId
     * @return type
     */
    public function getStudentStatusDifferences($studentId)
    {
        $storedProcedureQuery = 'CALL SP_DIFFERENCES_STUDENT_STATUS(:studentId)';

        $statement = $this->surveyEntitymanager->getConnection()->prepare($storedProcedureQuery);
        $statement->bindParam(':studentId',$studentId);

        $statement->execute();

        $result = $statement->fetchAll();

        return $result;
    }

}
