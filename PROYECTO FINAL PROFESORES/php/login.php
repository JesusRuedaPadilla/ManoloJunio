<?php
include_once "../helpers/Validator.php";
include_once "../helpers/Session.php";
include_once "../helpers/Login.php";
include_once "../helpers/ConexionBD.php"; 
include_once "../helpers/Validator.php"; 


  $obj=new stdClass();
  
  
  if(isset($_POST['user']) && isset($_POST['clave']) && !empty($_POST['user']) && !empty($_POST['clave'])){

    $correo = $_POST['user'];
    $contraseña = $_POST['clave'];
  
      if(ConexionBD::conecta()){

        if(ConexionBD::existeusuario($correo,$contraseña)){
                // echo "USUARIO LOGUEADO"."<br>";
                    
                Session::init();
                Session::escribir("correo",$correo);
                Session::escribir("contrasena",$contraseña);
            //    $a= Session::existe('correo');
            
            if(Login::UsuarioEstaLogueado()){
              $obj->success=true;
              $obj->user=ConexionBD::obtieneTodosDatos($correo);

                // header("Location:paginaInicio.php?p=1&t=3");
            }
          }
          else{
            $obj->success=false;
            $obj->error="El usuario no existe";
      
          }
        }
  }

  else{
    $obj->success=false;
    $obj->error="Revise el usuario y la contraseña";
  }

  echo json_encode($obj);
        
?>