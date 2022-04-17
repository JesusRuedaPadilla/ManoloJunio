<?php
  include_once "./helpers/Validator.php";
  include_once "./helpers/Session.php";
  include_once "./helpers/Login.php";
  include_once "./helpers/ConexionBD.php"; 

    $error="";
    if (isset($_POST['enviar']))
    {
        
        $correo = $_POST['correo'];
        $contraseña = $_POST['contrasena'];
      
            if(ConexionBD::conecta()){

                if(ConexionBD::existeusuario($correo,$contraseña)){
                        // echo "USUARIO LOGUEADO"."<br>";
                            
                        Session::init();
                       $SESIONCORREO = Session::escribir("correo",$correo);
                       $SESIONCONTRASEÑA = Session::escribir("contrasena",$contraseña);
                    //    $a= Session::existe('correo');
                    
                    if(Login::UsuarioEstaLogueado()){
                        header("Location:paginaInicio.php?p=1&t=3");
                    }

                }
                else{
                    echo "Usuario o contraseña incorrectos.<br> Compruebe los datos e intentelo de nuevo.";
                }
                
            }
           
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  
  <title>Login Banco</title>
  <link rel="stylesheet" href="./css/estilos.css">
  </head>

<body>
    
    <form action='' method='post'>
       
        
            <?php echo $error; ?>
    
    
        <br/>
            <label for='correo' >Email:</label><br/>
            <input type='text' name='correo' id='correo' maxlength="50" /><br/>
       
            <label for='contrasena' >Contraseña:</label><br/>
            <input type='password' name='contrasena' id='contrasena' maxlength="50" /><br/>

              
            <input type='submit' name='enviar' value='Aceptar' />
        

    </form>
   
</body>
</html>