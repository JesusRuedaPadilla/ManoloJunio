<?php
include_once "../helpers/Validator.php";
require_once ('../helpers/ConexionBD.php');

$valida=new Validator();

    if($valida->FormularioEnviado()){

        
        $correo=$_POST['correo'];
        $contraseña=$_POST['contrasena'];
        
        
        if($valida->Requerido($correo) && $valida->Requerido($contraseña) && $valida->Email($correo) && $valida->ContraseñaValidada($contraseña)){
            ConexionBD::conecta();
            var_dump(ConexionBD::obtieneUsuario($correo,$contraseña));
            
            
        }
        
        else{
            $valida->MuestraErrores($valida->getErrores());
            
        }

        
    
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  
  <title>Formulario BD</title>
  <link rel="stylesheet" href="./css/estilos.css">
  </head>

<body>
    
    <form action='' method='post'>
       
        <br/>
        <label for='correo' >Correo</label><br/>
            <input type="email" name='correo' id='correo' maxlength="50" /><br>
       
            <label for='contrasena' >Contraseña</label><br>
            <input type='password' name='contrasena' id='contrasena' maxlength="12"/><br></br>

            <button name='enviar' id='enviar' value="enviar">Enviar</button>
           
    </form>
   
</body>
</html>