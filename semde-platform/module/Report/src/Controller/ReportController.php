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

namespace Report\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Report\Form\Report1Form;
use Report\Form\Report2Form;
use Report\Form\Report3Form;
use Report\Form\Report4Form;
use Report\Form\Report5Form;
use Report\Controller\Helper\AuxiliaryControllerHelper;

/**
 * Description of ReportController
 *
 * @author Elder Mutzus <elmutzus@gmail.com>
 */
class ReportController extends AbstractActionController
{

    /**
     *
     * @var type 
     */
    private $reportManager;

    /**
     *
     * @var type 
     */
    private $sessionContainer;

    /**
     *
     * @var type 
     */
    private $auxiliaryHelper;

    /**
     * 
     * @param type $roleManager
     * @param type $sessionContainer
     */
    public function __construct($entityManager, $sessionContainer)
    {
        $this->reportManager    = $entityManager;
        $this->sessionContainer = $sessionContainer;
        $this->auxiliaryHelper  = new AuxiliaryControllerHelper($entityManager);
    }

    /**
     * 
     */
    private function setLayoutVariables()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/authenticated');
        $layout->setVariable('reportPages', $this->sessionContainer->reportPages);
        $layout->setVariable('managementPages', $this->sessionContainer->managementPages);
        $layout->setVariable('currentUser', $this->sessionContainer->currentUserName);
        $layout->setVariable('currentUserRole', $this->sessionContainer->currentUserRole);
    }

    /**
     * 
     * @return boolean
     */
    private function validateAuthentication()
    {
        return true;
    }

    /**
     * 
     */
    public function indexAction()
    {
        
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report1Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report1Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport1Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report1DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student     = $this->params()->fromQuery('si');
        $studentName = $this->params()->fromQuery('sn');
        $lowerValue  = $this->params()->fromQuery('sl');
        $topValue    = $this->params()->fromQuery('st');

        $addressDifferences          = $this->reportManager->getAddressDifferences($student);
        $brothersDifferences         = $this->reportManager->getBrothersDifferences($student);
        $fatherDifferences           = $this->reportManager->getFatherDifferences($student);
        $mateDifferences             = $this->reportManager->getMateDifferences($student);
        $motherDifferences           = $this->reportManager->getMotherDifferences($student);
        $professionalLifeDifferences = $this->reportManager->getProfessionalLifeDifferences($student);
        $socialLifeDifferences       = $this->reportManager->getSocialLifeDifferences($student);
        $studentStatusDifferences    = $this->reportManager->getStudentStatusDifferences($student);

        return new ViewModel([
            'studentId'                   => $student,
            'studentName'                 => $studentName,
            'studentLower'                => $lowerValue,
            'studentHigher'               => $topValue,
            'addressDifferences'          => $addressDifferences,
            'brothersDifferences'         => $brothersDifferences,
            'fatherDifferences'           => $fatherDifferences,
            'mateDifferences'             => $mateDifferences,
            'motherDifferences'           => $motherDifferences,
            'professionalLifeDifferences' => $professionalLifeDifferences,
            'socialLifeDifferences'       => $socialLifeDifferences,
            'studentStatusDifferences'    => $studentStatusDifferences,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report2Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report2Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport2Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report2DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student      = $this->params()->fromQuery('si');
        $studentName  = $this->params()->fromQuery('sn');
        $reportDetail = $this->reportManager->getReport2Detail($student);

        return new ViewModel([
            'studentId'    => $student,
            'studentName'  => $studentName,
            'reportDetail' => $reportDetail,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report3Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report3Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport3Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report3DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student      = $this->params()->fromQuery('si');
        $studentName  = $this->params()->fromQuery('sn');
        $reportDetail = $this->reportManager->getReport3Detail($student);

        return new ViewModel([
            'studentId'    => $student,
            'studentName'  => $studentName,
            'reportDetail' => $reportDetail,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report4Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report4Form();

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport4Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report4DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student      = $this->params()->fromQuery('si');
        $studentName  = $this->params()->fromQuery('sn');
        $studentNov   = $this->params()->fromQuery('nv');
        
        $reportDetail = $this->reportManager->getReport4Detail($student, $studentNov);

        return new ViewModel([
            'studentId'    => $student,
            'studentName'  => $studentName,
            'reportDetail' => $reportDetail,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report5Action()
    {
        $this->setLayoutVariables();

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $form = new Report5Form();

        $form = $this->auxiliaryHelper->fillOptionsData($form);

        if ($this->getRequest()->isPost())
        {
            $data = $this->params()->fromPost();

            $form->setData($data);

            if ($form->isvalid())
            {
                $reportData = $this->reportManager->getReport5Data($form->getData());

                return new ViewModel([
                    'form'       => $form,
                    'reportData' => $reportData,
                ]);
            }
        }

        return new ViewModel([
            'form' => $form,
        ]);
    }

    /**
     * 
     * @return ViewModel
     * @throws \Exception
     */
    public function report5DetailAction()
    {
        $layout = $this->layout();

        $layout->setTemplate('layout/report-detail');

        if (!$this->validateAuthentication())
        {
            throw new \Exception('No puede acceder a la información solicitada');
        }

        $student      = $this->params()->fromQuery('si');
        $studentName  = $this->params()->fromQuery('sn');
        $reportDetail = $this->reportManager->getReport5Detail($student);

        return new ViewModel([
            'studentId'    => $student,
            'studentName'  => $studentName,
            'reportDetail' => $reportDetail,
        ]);
    }

    public function reportExportAction()
    {
        $report = $this->params()->fromQuery('rpt');

        if ($report == 1)
        {
            $data = array();

            $data['career']   = $this->params()->fromQuery('crr');
            $data['year']     = $this->params()->fromQuery('yr');
            $data['course']   = $this->params()->fromQuery('crs');
            $data['semester'] = $this->params()->fromQuery('smstr');
            $data['dpi']      = $this->params()->fromQuery('dp');
            $data['nov']      = $this->params()->fromQuery('nv');
            $data['name']     = $this->params()->fromQuery('nm');
            $data['lastname'] = $this->params()->fromQuery('lstnm');
            $data['filterBy'] = $this->params()->fromQuery('fltrby');

            $reportData = $this->reportManager->getReport1Data($data);

            $filteredData = $this->createDataForReport1Export($reportData);

            $this->createExcelFile($filteredData, 'Reporte 1', 'Comparativo del promedio de notas Vs. un valor anterior');

            return $this->getResponse();
        }
        elseif ($report == 2)
        {
            $data = array();

            $data['career']   = $this->params()->fromQuery('crr');
            $data['year']     = $this->params()->fromQuery('yr');
            $data['course']   = $this->params()->fromQuery('crs');
            $data['semester'] = $this->params()->fromQuery('smstr');
            $data['dpi']      = $this->params()->fromQuery('dp');
            $data['nov']      = $this->params()->fromQuery('nv');
            $data['name']     = $this->params()->fromQuery('nm');
            $data['lastname'] = $this->params()->fromQuery('lstnm');
            $data['filterBy'] = $this->params()->fromQuery('fltrby');

            $reportData = $this->reportManager->getReport2Data($data);

            $filteredData = $this->createDataForReport2Export($reportData);

            $this->createExcelFile($filteredData, 'Reporte 2', 'Histórico');

            return $this->getResponse();
        }
        elseif ($report == 3)
        {
            $data = array();

            $data['career']      = $this->params()->fromQuery('crr');
            $data['year']        = $this->params()->fromQuery('yr');
            $data['course']      = $this->params()->fromQuery('crs');
            $data['semester']    = $this->params()->fromQuery('smstr');
            $data['dpi']         = $this->params()->fromQuery('dp');
            $data['nov']         = $this->params()->fromQuery('nv');
            $data['name']        = $this->params()->fromQuery('nm');
            $data['lastname']    = $this->params()->fromQuery('lstnm');
            $data['performance'] = $this->params()->fromQuery('prfrmnc');
            $data['filterBy']    = $this->params()->fromQuery('fltrby');

            $reportData = $this->reportManager->getReport3Data($data);

            $filteredData = $this->createDataForReport3Export($reportData);

            $this->createExcelFile($filteredData, 'Reporte 3', 'Proyección del rendimiento del estudiante');

            return $this->getResponse();
        }
        elseif ($report == 4)
        {
            
        }
        elseif ($report == 5)
        {
            $data = array();

            $data['career']   = $this->params()->fromQuery('crr');
            $data['year']     = $this->params()->fromQuery('yr');
            $data['course']   = $this->params()->fromQuery('crs');
            $data['semester'] = $this->params()->fromQuery('smstr');

            $reportData = $this->reportManager->getReport5Data($data);

            $filteredData = $this->createDataForReport5Export($reportData);

            $this->createExcelFile($filteredData, 'Reporte 5', 'Top de notas de estudiantes por curso');

            return $this->getResponse();
        }
    }

    /**
     * 
     * @param type $data
     * @return array
     */
    private function createDataForReport1Export($data)
    {
        $limit = sizeof($data);

        $rootData = array();

        array_push($rootData, ['Carné', 'N.O.V.', 'C.U.I.', 'Nombre', 'Promedio Anterior', 'Promedio Actual', 'Resultado']);

        for ($i = 0; $i < $limit; $i ++)
        {
            $rowData = array();

            $actualData = $data[$i];
            $prevData   = $data[$i + 1];

            $percentage = 0;

            array_push($rowData, $actualData['student']);
            array_push($rowData, $actualData['vocational_id']);
            array_push($rowData, $actualData['dpi']);
            array_push($rowData, $actualData['name']);

            if ($prevData['student'] == $actualData['student'])
            {
                array_push($rowData, $prevData['average']);

                $percentage = (($actualData['average'] * 100) / $prevData['average']) - 100;
                $i++;
            }
            else
            {
                array_push($rowData, '0');
            }

            array_push($rowData, $actualData['average']);
            array_push($rowData, $percentage);

            array_push($rootData, $rowData);
        }

        return $rootData;
    }

    /**
     * 
     * @param type $data
     * @return array
     */
    private function createDataForReport2Export($data)
    {
        array_unshift($data, ['Carné', 'N.O.V.', 'C.U.I.', 'Nombre', 'Promedio']);

        return $data;
    }

    /**
     * 
     * @param type $data
     * @return array
     */
    private function createDataForReport3Export($data)
    {
        array_unshift($data, ['Carné', 'N.O.V.', 'C.U.I.', 'Nombre', 'Promedio']);

        return $data;
    }

    /**
     * 
     * @param type $data
     * @return array
     */
    private function createDataForReport4Export($data)
    {
        array_unshift($data, ['Carné', 'N.O.V.', 'C.U.I.', 'Nombre', 'Promedio']);

        return $data;
    }

    /**
     * 
     * @param type $data
     * @return array
     */
    private function createDataForReport5Export($data)
    {
        array_unshift($data, ['Carné', 'N.O.V.', 'C.U.I.', 'Nombre', 'Promedio']);

        return $data;
    }

    /**
     * 
     * @param type $data
     * @param type $reportName
     * @param type $reportDescription
     */
    private function createExcelFile($data, $reportName, $reportDescription)
    {
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=Reporte.xls");
        header("Pragma: no-cache");
        header("Expires: 0");

        $centeredStyle = [
            'alignment' => [
                'horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ],
        ];

        $excel = new \PHPExcel();

        $excel->getProperties()->setCreator("Elder Mutzus");
        $excel->getProperties()->setLastModifiedBy("Elder Mutzus");
        $excel->getProperties()->setTitle($reportName);
        $excel->getProperties()->setSubject($reportName);
        $excel->getProperties()->setDescription($reportDescription);

        $excel->setActiveSheetIndex(0);

        // Set report title
        $excel->getActiveSheet()->setCellValue('A1', $reportName);
        $excel->getActiveSheet()->setCellValue('A2', $reportDescription);

        $rowCount = sizeof($data);

        $rowNumber       = 3;
        $columnNumber    = 0;
        $maxColumnNumber = 0;

        foreach ($data as $row)
        {
            $rowNumber++;
            $columnNumber = 0;

            if ($maxColumnNumber == 0)
            {
                $maxColumnNumber = sizeof($row);
            }

            foreach ($row as $column)
            {
                $excel->getActiveSheet()->setCellValueByColumnAndRow($columnNumber, $rowNumber, $column);
                $excel->getActiveSheet()->getColumnDimensionByColumn($columnNumber)->setAutoSize(true);
                $columnNumber++;
            }
        }

        $excel->getActiveSheet()->mergeCellsByColumnAndRow(0, 1, $maxColumnNumber - 1, 1);
        $excel->getActiveSheet()->mergeCellsByColumnAndRow(0, 2, $maxColumnNumber - 1, 2);

        $excel->getActiveSheet()->getStyle('A1')->applyFromArray($centeredStyle);
        $excel->getActiveSheet()->getStyle('A2')->applyFromArray($centeredStyle);

        $excel->getActiveSheet()->setTitle($reportName);

        // Set borders
        $excel->getActiveSheet()
                ->getStyleByColumnAndRow(0, 4, $maxColumnNumber - 1, $rowCount + 3)
                ->getBorders()
                ->getAllBorders()
                ->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        // Set table header colors
        $excel->getActiveSheet()
                ->getStyleByColumnAndRow(0, 4, $maxColumnNumber - 1, 4)
                ->getFill()
                ->applyFromArray([
                    'type'       => \PHPExcel_Style_Fill::FILL_SOLID,
                    'startcolor' => [
                        'rgb' => '192949'
                    ],
        ]);

        // Set the font text
        $excel->getActiveSheet()
                ->getStyleByColumnAndRow(0, 4, $maxColumnNumber - 1, 4)
                ->applyFromArray([
                    'font' => [
                        'color' => [
                            'rgb' => 'FFFFFF'
                        ],
                    ],
        ]);

        $excel->getActiveSheet()
                ->getStyleByColumnAndRow(0, 1, 1, 2)
                ->applyFromArray([
                    'font' => [
                        'bold' => true
                    ],
        ]);

        $objWriter = new \PHPExcel_Writer_Excel2007($excel);
        $objWriter->save('php://output');
    }

}
