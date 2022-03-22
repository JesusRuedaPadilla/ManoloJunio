<?php
class Validator{

    private $errores=array();

  
        function CompruebaVacio($vacio){

            if(empty($_POST[$vacio])){
                $errores[$vacio]= "Comprueba que has escrito todos los datos";
    
            }

            return $errores;
            
        }

        function CompruebaSiNumero($valor){

            if(is_numeric($valor)){

                return true;
            }

            else{

                $errores[$valor]= "El dato proporcionado no es un valor numerico";
                return $errores;
            }
        }


    
        function MuestraErrores($errores){
    
    
                for($i=0; $i<sizeof($errores); $i++){
                
                    echo $errores[$i];
                    echo "<br>";
                }
        }
        



}

?>