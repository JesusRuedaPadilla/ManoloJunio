<?php
  $errores= array();

    function CommpruebaErrores(){


        if(empty($_GET['numero1'])){
            $errores[]= "Comprueba que has escrito el Primer numero";

        }

        if(empty($_GET['numero2'])){
            $errores[]= "Comprueba que has escrito el Segundo numero";
            
        }

        if(empty($_GET['operador'])){
            $errores[]= "Comprueba el operador escogido";
            
        }

        if(count($errores)==0){

            return false;
            
        
        }
        
        else{
        
        return true;
        
        
        }
        
    }

    function MuestraErrores(){

            $errores=array();

            for($i=0; $i<sizeof($errores); $i++){
            
                echo $errores[$i];
                echo "<br>";
            }
    }
    

    if(CommpruebaErrores()==false){

        if(isset($_GET['numero1']) && isset($_GET['numero2']) && isset($_GET['operador'])){
        
            $n1= $_GET['numero1'];
        
            $n2= $_GET['numero2'];
        
            $op= $_GET['operador'];
        
                // %2B -- Codigo suma ASCII
        
            if($op=='+'){
                $resultado= $n1+$n2;
                echo "El resultado de la suma es " .$resultado;
            }
        
            else if($op=='-'){
        
                $resultado= $n1-$n2;
                echo "El resultado de la resta es " .$resultado;
            }
        
            else if($op=='*'){
                $resultado= $n1*$n2;
                echo "El resultado de la multiplicacion es " .$resultado;
            }
        
            else if($op=='/'){
                $resultado= $n1/$n2;
                echo "El resultado de la division es " .$resultado;
            }
        
        
        } 
}

if(CommpruebaErrores()==true){
    
    MuestraErrores();
    // echo "Comprueba los datos introducidos";
}



?>