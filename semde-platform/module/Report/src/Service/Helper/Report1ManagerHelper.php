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
        $queryString = "select rf.*
                        from (
                                select ro.*,
                                        (@num:=if(@student = student, @num + 1, if(@student := student, 1, 1))) row_number 
                                from (
                                        select ri.student,
                                                ri.year,
                                                ri.semester,
                                                sum(ri.official_note) / count(1) as average,
                                    s.dpi,
                                    s.vocational_id,
                                    s.name
                                        from results ri
                                inner join student s
                                                on ri.student = s.student";

        $queryType = $data['filterBy'];

        // Search using Career
        if ($queryType == 'C')
        {
            $queryString .= "               where (ri.career = '" . $data['career'] . "' or " . $data['career'] . " = -1)
                                                and (ri.course = '" . $data['course'] . "' or " . $data['course'] . " = -1)
                                                and (ri.year = '" . $data['year'] . "' or length('" . $data['year'] . "') = 0)
                                                and (ri.semester = '" . $data['semester'] . "' or " . $data['semester'] . " = -1)";
        }
        // Search using student
        else if ($queryType == 'S')
        {
            $queryString .= "               where (s.dpi like '" . $data['dpi'] . "%' or length('" . $data['dpi'] . "') = 0)
                                                and (s.vocational_id like '" . $data['nov'] . "%' or length('" . $data['nov'] . "') = 0)
                                                and (s.name like '" . $data['name'] . "%' or length('" . $data['name'] . "') = 0)
                                                and (s.name like '%" . $data['lastname'] . "%' or length('" . $data['lastname'] . "') = 0)";
        }

        $queryString .= "                   group by ri.student, ri.year, ri.semester
                                            order by ri.student, ri.year desc, ri.semester desc
                                    ) as ro
                            ) as rf
                            where rf.row_number <= 2 limit 50";
    
        $statement = $this->entityManager->getConnection()->prepare($queryString);
        $statement->execute();
        
        return $statement->fetchAll();
    }

}
