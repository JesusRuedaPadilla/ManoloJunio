<?php
class Validator{

    private $errores=array();

        function CompruebaVacio($vacio){

            if(empty($_POST[$vacio])){

                $this->errores[$vacio."vacio"]= $vacio . "esta vacio";
    
            }
            
        }

        function CompruebaSiNumero($valor){

            if(is_numeric($valor)){

                return true;
            }

            else{

               $this->errores[$valor .""]= $valor . "no es un numero";
            }
        }

        function getErrores(){
    
           return $this->errores;
        }
}

?>