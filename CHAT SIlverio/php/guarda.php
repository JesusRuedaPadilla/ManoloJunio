<?php
require_once("BD.php");
 

 if(isset($_POST['enviar'])){

  if(BD::conecta()){
    echo "Ahora si le gusta";
  }

   
    // ConexionBD::InsertaMensajes($_POST['usuario'],$_POST['mensaje']);
   
  
 }

?>