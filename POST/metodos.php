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
        
        return $errores;
        
        
        }
        
    }

    function MuestraErrores($errores){

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

function PintaFormularioPHP(){

    
        
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
function EscribeFormularioHTML(){
    //EOD (para escribir una cadena larga y que se muestre tal y como esta)
    $str = <<<EOD
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
    
    EOD;
    echo $str;
}

?>
