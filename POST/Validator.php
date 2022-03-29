<?php
class Validator{

    private $errores=array();

        function CompruebaVacio($vacio){

            if(empty($_POST[$vacio])){

                $this->errores[$vacio."vacio"]= $vacio . "esta vacio";
    
            }
            
        }
        // public function requerido($campo){
            
        //     if(!isset($_POST[$campo] ||empty($_POST[$campo])){

        //         $this->errores[$vacio."vacio"]= $vacio . "esta vacio";
    
        //     }
        // }


        function getErrores(){
    
           return $this->errores;
        }

        //filter_var($_POST[$campo],FILTER_VALIDATE_EMAIL); //Validar que lo introducido es un email

        // public function Dni($campo){
        //     $letras="TR";
        //     $mensaje="";
           
        //     if(preg_match("A/[0-9]",$_POST[$campo])==1)//Empieza por (preg_match){
            //     $numero=substr($_POST[$campo],0,8);
        //         $letra=substr($_POST[$campo],8,1);
        //         if($letras[$numero%23]==strtoupper($letra)){
        //             return true;
        //         }
        //         else{
        //             $mensaje="El campo $campo es un dni con una letra no valida";
        //         }

        //     }
        //     else{

        //     }
        //     this->errores[$campo]
        // }
        // call_user_func($funcion) Para ejecutar una funcion que le demos como parametro a otra funcion (ej: una funcion llama a imprimir error)
}

?>