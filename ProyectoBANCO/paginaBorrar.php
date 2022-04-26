<?php
include_once "./helpers/Session.php";
 include_once "./helpers/Login.php";
 include_once "./helpers/ConexionBD.php"; 
 include_once "./Clases/Persona.php"; 
 
 Session::init();
            
    if(Login::UsuarioEstaLogueado()){
        
    
    $p=$_GET['p'];
    $cant=$_GET['cant'];

        ConexionBD::conecta();
        $correo=Session::leer('correo');

        $persona=ConexionBD::obtienePersona($correo);
        $gastos=ConexionBD::obtieneGastos($persona->getId(),$cant);

           if(ConexionBD::BorrarDatosIngresos($gastos)){
             header("Location:paginaInicio.php?p=1&t=3");
           } 
           else{
            ConexionBD::BorrarDatosGastos($gastos);
            header("Location:paginaInicio.php?p=1&t=3");
           }
      
    
    }
    
        

  
    
    if(isset($_POST['logout'])){

 
        Session::destruir();
       
        header("Location:paginaLogin.php");
    
    }
?>


