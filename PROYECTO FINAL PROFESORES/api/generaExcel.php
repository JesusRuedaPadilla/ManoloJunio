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
// $nombreProf=$visitas[0][0]->nombreProf;
// $localidad=$visitas[0][0]->localidad;
// $localidad=$localidad;
// $provincia=$visitas[0][0]->provincia;
// $nombreAlumno=$visitas[0][0]->nombreAlumno;
// $dietas=$visitas[0][0]->dietas;
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

$sheet->getColumnDimension('A')->setWidth(30);
$sheet->getColumnDimension('B')->setWidth(10);
$sheet->getColumnDimension('C')->setWidth(10);
$sheet->getColumnDimension('D')->setWidth(13);
$sheet->getColumnDimension('E')->setWidth(12);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(12);
$sheet->getColumnDimension('H')->setWidth(10);
$sheet->getColumnDimension('I')->setWidth(5);
$obj=new stdClass();
for($i=1;$i<=count($visitas);$i++){

    if(!isset($visitas[$i-1][0]->nombreProf)){
        $nombreProf=null;
        $localidad=null;
        $provincia=null;
        $nombreAlumno=null;
        $dietas=null;
        $fecha_inicio=null;
        $hora_inicio=null;
        $fecha_fin=null;
        $hora_fin=null;
        
    $obj->success=false;
    }
    else{
    
        $nombreProf=$visitas[$i-1][0]->nombreProf;
        $localidad=$visitas[$i-1][0]->localidad;
        $provincia=$visitas[$i-1][0]->provincia;
        $nombreAlumno=$visitas[$i-1][0]->nombreAlumno;
        $dietas=$visitas[$i-1][0]->dietas;
        $fecha_inicio=$visitas[$i-1][0]->fecha_inicio;
        $hora_inicio=$visitas[$i-1][0]->hora_inicio;
        $fecha_fin=$visitas[$i-1][0]->fecha_fin;
        $hora_fin=$visitas[$i-1][0]->hora_fin;

        
        $sheet->setCellValue("A$i", "$nombreProf");
        $sheet->setCellValue("B$i", "$localidad");
        $sheet->setCellValue("C$i", "$provincia");
        $sheet->setCellValue("D$i", "$nombreAlumno");
        $sheet->setCellValue("E$i", "$fecha_inicio");
        $sheet->setCellValue("F$i", "$hora_inicio");
        $sheet->setCellValue("G$i", "$fecha_fin");
        $sheet->setCellValue("H$i", "$hora_fin");
        $sheet->setCellValue("I$i", "$dietas");
        
    $obj->success=true;
    }
    


    // $sheet->setCellValue('B1', 'HOLAAA');
}



// $hola="HOLA";
// $sheet->setCellValue('A1', "$localidad");

// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Content-Disposition: attachment;filename="Visitas.xlsx"');
// header('Cache-Control: max-age=0');

// $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
// $writer->save('php://output');

$writer = new Xlsx($spreadsheet);

$writer->save('visitas.xlsx');
      


echo json_encode($obj);



?>

