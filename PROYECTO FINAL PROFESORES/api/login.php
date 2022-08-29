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
        if(!ConexionBD::existeProfesor($correo,$contraseña)){
          $obj->success=false;
          $obj->error="El usuario o la contraseña son incorrectos";
        }
        if(ConexionBD::existeProfesor($correo,$contraseña)){
                // echo "USUARIO LOGUEADO"."<br>";
                    
                Session::init();
                Session::escribir("correo",$correo);
                Session::escribir("contrasena",$contraseña);
                
            //    $a= Session::existe('correo');
            
            if(Login::UsuarioEstaLogueado()){
              if($contraseña==($correo.$correo)){
                $obj->contraseñaCambiada=false;
                $obj->user=$correo;
                
              }

              else{
              
                  $obj->contraseñaCambiada=true;
                  $obj->success=true;
                  $obj->user=ConexionBD::obtieneTodosDatos($correo);
                  $obj->usuario=$correo;
                  $obj->admin=false;
                  for ($i=0;$i<count($obj->user);$i++){
                      $idAlumno= $obj->user[$i]["id_alumno_detalle_convenio"];
                       $obj->user[$i]["visitas"]=ConexionBD::obtieneVisitas($idAlumno);
                       
                  }
                
               
              }
            }
          }
            if(ConexionBD::existeAdmin($correo,$contraseña)){
  
              Session::init();
              Session::escribir("correo",$correo);
              Session::escribir("contrasena",$contraseña);
              Session::escribir("rol","administrador");
  
              if(Login::AdminLogueado()){
                if($contraseña==($correo.$correo)){
                  $obj->contraseñaCambiada=false;
                  $obj->user=$correo;
                }
                else{
                  $obj->usuario=$correo;
                  $obj->contraseñaCambiada=true;
                  $obj->success=true;
                  $obj->profesor=ConexionBD::obtieneProfesores();
                  $obj->admin=true;
                  for($i=0;$i<count($obj->profesor);$i++){
                    $id_usuario=$obj->profesor[$i]["id_usuario"];
                    $obj->profesor[$i]['datos']=ConexionBD::obtieneTodosDatos($id_usuario);
    
                    for($j=0;$j<count($obj->profesor[$i]['datos']);$j++){
                      $idAlumno= $obj->profesor[$i]['datos'][$j]["id_alumno_detalle_convenio"];
                      $obj->profesor[$i]['datos'][$j]["visitas"]=ConexionBD::obtieneVisitas($idAlumno);
                    }
                 
                  }
        
              }
            }
            
          }
       }
             
     
  }
  else{
    $obj->success=false;
    $obj->error="Revise el usuario y la contraseña";

  }


  echo json_encode($obj);

?>