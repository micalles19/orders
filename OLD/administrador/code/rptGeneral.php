<?php
header("Content-type: application/json; charset=utf-8");
$input = json_decode(file_get_contents("php://input"), true);
session_start();

require __DIR__ . "/../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
include "MySQL_conection.php";

$spreadsheet = new Spreadsheet();

$spreadsheet->getProperties()
    ->setCreator("mcadev.com")
    ->setLastModifiedBy('usuario') // última vez modificado por
    ->setTitle('Reporte general')
    ->setSubject('Reporte general')
    ->setDescription('Este documento fue generado por stacy painting');

// Obtiene la hoja activa actual y la renombra
$sheet1 = $spreadsheet->getActiveSheet();
$sheet1->setTitle('Hoja 1');

$row =2;
$total =0.0;
// Agrega datos a las celdas de la Hoja 1
$sheet1->setCellValue('A1', 'N');
$sheet1->setCellValue('B1', 'Cliente ');
$col_dim = $sheet1->getColumnDimension('B');
$col_dim->setAutoSize(true);
$sheet1->setCellValue('C1', 'Nombre Proyecto');
$col_dim = $sheet1->getColumnDimension('C');
$col_dim->setAutoSize(true);
$sheet1->setCellValue('D1', 'Invoice');
$col_dim = $sheet1->getColumnDimension('D');
$col_dim->setAutoSize(true);
$sheet1->setCellValue('E1', 'Precio');
$col_dim = $sheet1->getColumnDimension('E');
$col_dim->setAutoSize(true);
$sheet1->setCellValue('F1', 'Estado del Pago');
$col_dim = $sheet1->getColumnDimension('F');
$col_dim->setAutoSize(true);
$sheet1->setCellValue('G1', 'Fecha del Proyecto');
$col_dim = $sheet1->getColumnDimension('G');
$col_dim->setAutoSize(true);

for ($i = 0 ; $i <= count($input["datos"])-1 ; $i++){
    $sheet1->setCellValue('A'.$row, $i+1);
    $sheet1->setCellValue('B'.$row, $input["datos"][$i]["nombreCliente"]);
    $sheet1->setCellValue('C'.$row,  $input["datos"][$i]["nombreProyecto"]);
    $sheet1->setCellValue('D'.$row,  $input["datos"][$i]["invoice"]);
    $sheet1->setCellValue('E'.$row,  $input["datos"][$i]["precioProyecto"]);
    $style = $sheet1->getStyle('E'.$row);

    $style->getNumberFormat()->setFormatCode('#,##0.00');
    $sheet1->setCellValue('F'.$row,  $input["datos"][$i]["estadoPago"]);
    $sheet1->setCellValue('G'.$row,  $input["datos"][$i]["fechaEjecucion"]);
    $row ++;
    $total += $input["datos"][$i]["precioProyecto"];
}
$sheet1->setCellValue('E'.$row, $total);
$style = $sheet1->getStyle('E'.$row);
$style->getNumberFormat()->setFormatCode('#,##0.00');

$writer = new Xlsx($spreadsheet);

// Define el nombre del archivo Excel
$filename = 'reporteGeneral-'.date('d-m-y').'.xlsx';

// Guarda el archivo Excel en el disco
$writer->save(__DIR__.'/../reportesExcel/'.$filename);

echo json_encode($filename);
