<?php
  include_once "metodos.php";
  require_once "Validator.php";
  
    if(CommpruebaErrores()==false){
        
            PintaFormularioPHP();
              
        }
        
        else{
        
           MuestraErrores($errores);
           
        }     
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  
  <title>Cosa</title>
  <link rel="stylesheet" href="./css/estilos.css">
  </head>

<body>

    <?php
        EscribeFormularioHTML();
    ?>

</body>
</html>