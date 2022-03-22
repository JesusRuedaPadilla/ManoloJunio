<?php
  include_once "metodos.php";
  include_once "Validator.php";

    $valida=new Validator();

    $valida->CompruebaVacio("numero1");
    $valida->CompruebaVacio("numero2");
    $valida->CompruebaSiNumero("numero1");
    $valida->CompruebaSiNumero("numero2");
    
//    var_dump($valida->getErrores());
if(FormularioEnviado()){
    if($valida->getErrores()){
        

        MuestraErrores($valida->getErrores());
            
              
        }
        
        else{
        
            PintaFormularioPHP();
           
        }     
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