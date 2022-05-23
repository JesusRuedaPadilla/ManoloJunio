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

      
            if(Login::UsuarioEstaLogueado()){


            $obj->success=true;
            $obj->user=ConexionBD::obtieneTodosDatos($correo);

            for ($i=0;$i<count($obj->user);$i++){
                $idAlumno= $obj->user[$i]["id_alumno_detalle_convenio"];
                    $obj->user[$i]["visitas"]=ConexionBD::obtieneVisitas($idAlumno);
            }

            }

            else{
            $obj->success=false;
            $obj->error="Algo ha ido mal";

            }


    }

echo json_encode($obj);

?>