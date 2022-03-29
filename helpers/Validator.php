<?php
class Validator{

    private $errores=array();

        function CompruebaVacio($vacio){

            if(empty($_POST[$vacio])){

                $this->errores[$vacio."vacio"]= $vacio . "esta vacio";
    
            }
            
        }

        function FormularioEnviado(){
        
            if (isset($_POST['correo']) || isset($_POST['contrasena'])){
    
                return true;
    
            }
            else{
                return false;
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

        function Email($campo)
            {
                if(!filter_var($campo,FILTER_VALIDATE_EMAIL))
                {
                    $errores[$campo]="Debe ser un email válido";
                    return false; 
                }
                return true;
            }

        function ContraseñaValidada($contraseña){

                if(preg_match("^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,12}$^",$contraseña)==1)
                {
                    return true;
                }

                else
                {
                    $mensaje="El campo $contraseña no es válida (debe tener al menos de 8 a 12 caracteres, una Mayuscula, un numero, y un signo de puntuacion";
                }
                $errores[$contraseña]=$mensaje;
                return FALSE;
        }
        

        function Dni($campo)
            {
            $letras="TRWAGMYFPDXBNJZSQVHLCKE";
            $mensaje="";
                if(preg_match("/^[0-9]{8}[a-zA-z]{1}$/",$_POST[$campo])==1)
                {
                    $numero=substr($_POST[$campo],0,8);
                    $letra=substr($_POST[$campo],8,1);
                    if($letras[$numero%23]==strtoupper($letra))
                    {
                        return TRUE;
                    }
                    else
                    {
                        $mensaje="El campo $campo es un Dni con letra no válida";
                    }
                }

                else
                {
                    $mensaje="El campo $campo no es un Dni válido";
                }
                $this->errores[$campo]=$mensaje;
                return FALSE;
            }

        function ValidacionPasada()
            {
                if(count($this->errores)!=0)
                {
                    return false;
                }
                return true;
            }  
            
           function Requerido($campo)
            {
                if(!isset($campo) || empty($campo))
                {
                   $errores[$campo]="El campo $campo no puede estar vacio";
                    return false;
                }
                return true;
            }

            function MuestraErrores($erroresDetec){
    
                foreach($erroresDetec as $valor){
                
                    echo $valor;
                    echo "<br>";
                }
        }

}

?>