<?php
// require 'vendor/autoload.php';

// use PhpOffice\PhpSpreadSheet\SpreadSheet;

// $spreadsheet= new SpreadSheet();

// $spreadsheet->getProperties()->setCreator("Jose Manuel Foronda");

require '../vendor/autoload.php';
include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 

use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;
$visitas=$_POST['visitas'];

$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()->setCreator("Jose Manuel Foronda");
$spreadsheet->getProperties()->setTitle("Visitas");
$spreadsheet->getActiveSheetIndex(0);

$spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma');

$sheet = $spreadsheet->getActiveSheet();

for($i=0;$i<count($visitas);$i++){
    $sheet->setCellValue('A1', 'Hello World !');
    $sheet->setCellValue('B1', 'HOLAAA');
}


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Visitas.xlsx"');
header('Cache-Control: max-age=0');

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

// $writer = new Xlsx($spreadsheet);
// $writer->save('visitas.xlsx');

?>