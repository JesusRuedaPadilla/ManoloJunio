<?php
include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 


 $obj=new stdClass();
            Session::init();
            ConexionBD::conecta();
            $id_visita=$_POST["id_visita"];
            ConexionBD::BorrarVisita($id_visita);
       
                    $obj->success=true;
                
    
            // $obj->success=false;
            // $obj->error="La sesion no se ha podido cerrar.";

  echo json_encode($obj);

?>