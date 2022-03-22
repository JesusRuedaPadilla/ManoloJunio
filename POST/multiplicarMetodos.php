<?php
  include_once "metodos.php";

  
    
    if(CommpruebaErrores()==false){
        
            PintaFormulario();
              
        }
        
        else{
        
           MuestraErrores();
           
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
    
    <form action='mutiplicarPost.php' method='post'>
       
        <br/>
        <label for='numero1' ></label><br/>
            <input type='text' name='numero1' id='numero1' maxlength="50" /><br>
       
            <label for='numero2' ></label><br>
            <input type='numero2' name='numero2' id='numero2' maxlength="50" /><br></br>

            <button name='suma' id='suma' value="suma">Sumar</button>
            <button name='resta' id='resta' value="resta">Restar</button>
            <button name='multiplica' id='multiplica' value="multiplica">Multiplicar</button>
            <button name='divide' id='divide' value="divide">Dividir</button>
              
        

    </form>
   
</body>
</html>