<?php
include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 
include_once "../helpers/Validator.php"; 


  $obj=new stdClass();
  
  $id_usuario = $_POST['user'];
  $contraseña = $_POST['clave'];
  $contraseñaAntigua=$_POST['claveOld'];

  if(isset($_POST['user']) && isset($_POST['clave']) && !empty($_POST['user']) && !empty($_POST['clave']) && !empty($_POST['claveOld'])){
   
  
      if(ConexionBD::conecta()){
        $contraseñaActualEnBD=ConexionBD::dameContraseña($id_usuario);
        if($contraseñaAntigua==$contraseñaActualEnBD['contrasena']){

          Session::init();
          ConexionBD::ActualizaContraseña($id_usuario,$contraseña);
          $obj->succes=true;
        }
      else{
        $obj->error="Ha ocurrido un error, compruebe las contraseñas introducidas";
      }
      }
      
    else{
        $obj->succes=false;
    } 
} 
Session::destruir();
  echo json_encode($obj);


?>