<?php

include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 
include_once "../helpers/Validator.php"; 


  $obj=new stdClass();
  
    $chequeo = $_POST['check'];

      if(ConexionBD::conecta()){

            ConexionBD::ActualizaContraseña($id_usuario,$contraseña);
            $obj->succes=true;
          
      }
      
    else{
        $obj->succes=false;
    } 

  echo json_encode($obj);



?>