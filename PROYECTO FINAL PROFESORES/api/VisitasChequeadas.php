<?php

include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 
include_once "../helpers/Validator.php"; 


  $obj=new stdClass();
  
    $id_visita = $_POST['id_visita'];
    $dieta = $_POST['dieta'];
    if(ConexionBD::conecta()){
      if($dieta==1){
  
        ConexionBD::ActualizaDietasACero($id_visita);
        $obj->succes=true;
      
  
    }
    else{

            ConexionBD::ActualizaDietas($id_visita);
            $obj->succes=true;
          
      }
    }
  
    else{
        $obj->succes=false;
    } 

  echo json_encode($obj);



?>