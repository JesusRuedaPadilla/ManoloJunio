<?php
include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 


 $obj=new stdClass();
            Session::init();
            ConexionBD::conecta();
            $Visita= json_decode($_POST['visita']);
            $id_usuario=$_POST['id_usuario'];
        if($Visita==null){
          $obj->fallo=true;
        }
        
        else{
          $hola=ConexionBD::solapaVisita($Visita, $id_usuario);
         
        if($hola==0){
          $registro=ConexionBD::InsertarVisitas($Visita);
          $obj->success=true;
          $obj->response=$registro;
          
        }
        else if($hola!=0){
          $obj->fallo=true;
        }
          
        }
           
        
             
                

            // $obj->success=false;
            // $obj->error="La sesion no se ha podido cerrar.";

  echo json_encode($obj);

?>