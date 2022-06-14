<?php
     include_once "../helpers/Validator.php";
     include_once "../helpers/Session.php";
     include_once "../helpers/Login.php";
     include_once "../helpers/ConexionBD.php"; 
     include_once "../helpers/Validator.php"; 
     
     $obj=new stdClass();
     Session::init();

     if(ConexionBD::conecta()){
            $correo=Session::leer('correo');
            $contraseña= Session::leer('contrasena');
            $rol=Session::leer('rol');
      
            if(Login::UsuarioEstaLogueado() && ConexionBD::existeProfesor($correo,$contraseña)){
              if($contraseña==($correo.$correo)){
                $obj->contraseñaCambiada=false;
                $obj->user=$correo;
                
              }
              else{
                $obj->success=true;
                $obj->contraseñaCambiada=true;
                $obj->user=ConexionBD::obtieneTodosDatos($correo);
                $obj->usuario=$correo;
                $obj->admin=false;
                for ($i=0;$i<count($obj->user);$i++){
                    $idAlumno= $obj->user[$i]["id_alumno_detalle_convenio"];
                        $obj->user[$i]["visitas"]=ConexionBD::obtieneVisitas($idAlumno);
                }
              }
           

            }

            if(Login::AdminLogueado() && ConexionBD::existeAdmin($correo,$contraseña)){
              if($contraseña==($correo.$correo)){
                $obj->contraseñaCambiada=false;
                $obj->user=$correo;
                
              }
              else{
                $obj->usuario=$correo;
                $obj->success=true;
                $obj->contraseñaCambiada=true;
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
    else{
        $obj->success=false;
        $obj->error="Algo ha ido mal";

        }
        
echo json_encode($obj);

?>
