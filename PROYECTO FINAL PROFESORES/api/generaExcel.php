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

$visitas=json_decode($_POST['DatosVisitas']);
$nombreProf=$visitas[0][0]->nombreProf;
$localidad=$visitas[0][0]->localidad;
$localidad=$localidad;
$provincia=$visitas[0][0]->provincia;
$nombreAlumno=$visitas[0][0]->nombreAlumno;
$dietas=$visitas[0][0]->dietas;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use \PhpOffice\PhpSpreadsheet\IOFactory;

// $hola=$visita[0][0]->nombreProf;
// $obj->user[$i]["visitas"]
// $obj->user=ConexionBD::obtieneTodosDatos($correo);

$spreadsheet = new Spreadsheet();

$spreadsheet->getProperties()->setCreator("Jose Manuel Foronda");
$spreadsheet->getProperties()->setTitle("Visitas");
$spreadsheet->getActiveSheetIndex(0);

$spreadsheet->getDefaultStyle()->getFont()->setName('Tahoma');

$sheet = $spreadsheet->getActiveSheet();

for($i=1;$i<count($visitas);$i++){

    $nombreProf=$visitas[$i][0]->nombreProf;
$localidad=$visitas[$i][0]->localidad;
$provincia=$visitas[$i][0]->provincia;
$nombreAlumno=$visitas[$i][0]->nombreAlumno;
$dietas=$visitas[$i][0]->dietas;

    $sheet->setCellValue("A$i", "$nombreProf");
    $sheet->setCellValue("B$i", "$localidad");
    $sheet->setCellValue("C$i", "$provincia");
    $sheet->setCellValue("D$i", "$nombreAlumno");
    $sheet->setCellValue("E$i", "$dietas");
    // $sheet->setCellValue('B1', 'HOLAAA');
}



// $hola="HOLA";
// $sheet->setCellValue('A1', "$localidad");

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Visitas.xlsx"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');

$writer = new Xlsx($spreadsheet);
$writer->save('visitas.xlsx');

?>