<?php

  $errores= array();
  if (isset($_POST['suma']) || isset($_POST['resta']) || isset($_POST['multiplica']) || isset($_POST['divide'])){
    $errores= array();

    if(empty($_POST['numero1'])){
        $errores[]= "Comprueba que has escrito el Primer numero";
    
    }
    
    if(empty($_POST['numero2'])){
        $errores[]= "Comprueba que has escrito el Segundo numero";
        
    }
    
    
    if(count($errores)==0){
        if(isset($_POST['numero1']) && isset($_POST['numero2'])){
    
            $n1= $_POST['numero1'];
        
            $n2= $_POST['numero2'];

       
                // %2B -- Codigo suma ASCII
              $sumar= $_POST['suma'];
              $restar=  $_POST['resta'];
              $multiplicar=  $_POST['multiplica'];
              $dividir=  $_POST['divide'];

            if($sumar){
                $resultado= $n1+$n2;
                echo "El resultado de la suma es " .$resultado;
            }
        
            else if($restar){
        
                $resultado= $n1-$n2;
                echo "El resultado de la resta es " .$resultado;
            }
        
            else if($multiplicar){
                $resultado= $n1*$n2;
                echo "El resultado de la multiplicacion es " .$resultado;
            }
        
            else if($dividir){
                $resultado= $n1/$n2;
                echo "El resultado de la division es " .$resultado;
            }
        
        
        }
        
    
    }
    
    else{
    
        for($i=0; $i<sizeof($errores); $i++){
        
            echo $errores[$i];
            echo "<br>";
        }
       
       
    }
} 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  
  <title>Login Tienda Web</title>
  <link rel="stylesheet" href="./css/estilos.css">
  </head>

<body>
    
    <form action='mutiplicarPost.php' method='post'>
       
               

        <br/>
        <label for='numero1' ></label><br/>
            <input type='text' name='numero1' id='numero1' maxlength="50" /><br/>
       
            <label for='numero2' ></label><br/>
            <input type='numero2' name='numero2' id='numero2' maxlength="50" /><br/>
 
            <button name='suma' id='suma' value="suma">Sumar</button>
            <button name='resta' id='resta' value="resta">Restar</button>
            <button name='multiplica' id='multiplica' value="multiplica">Multiplicar</button>
            <button name='divide' id='divide' value="divide">Dividir</button><br>
              
        

    </form>
   
</body>
</html>