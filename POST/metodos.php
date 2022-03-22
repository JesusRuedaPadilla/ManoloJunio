<?php
  $errores= array();

    function CommpruebaErrores(){
        $errores= array();

        if(empty($_POST['numero1'])){
            $errores[]= "Comprueba que has escrito el Primer numero";

        }

        if(empty($_POST['numero2'])){
            $errores[]= "Comprueba que has escrito el Segundo numero";
            
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
    
    function FormularioEnviado(){
        if (isset($_POST['suma']) || isset($_POST['resta']) || isset($_POST['multiplica']) || isset($_POST['divide'])){

            return true;

        }
        else{
            return false;
        }

    }

function PintaFormulario(){

    if(isset($_POST['numero1']) && isset($_POST['numero2'])){
        
        $n1= $_POST['numero1'];
    
        $n2= $_POST['numero2'];

            // %2B -- Codigo suma ASCII/
        if(isset($_POST['suma'])){
            $resultado= $n1+$n2;
            echo "El resultado de la suma es " .$resultado;
        }
    
        else if(isset($_POST['resta'])){
    
            $resultado= $n1-$n2;
            echo "El resultado de la resta es " .$resultado;
        }
    
        else if(isset($_POST['multiplica'])){
            $resultado= $n1*$n2;
            echo "El resultado de la multiplicacion es " .$resultado;
        }
    
        else if(isset($_POST['divide'])){
            $resultado= $n1/$n2;
            echo "El resultado de la division es " .$resultado;
        }
    
    
    }
}



?>
