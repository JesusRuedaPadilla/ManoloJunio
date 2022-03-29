<?php
require_once ('../User.php');

class ConexionBD{

    private static $con;

    public static function conecta()
    {
       self::$con = new PDO('mysql:host=localhost;dbname=formularioprimero', 'root','');
    }

    public static function obtieneUsuario($correo,$contraseña)
    {
        
        $res= self::$con->query("select * from prueba1 where correo ='$correo' and contrasena='$contraseña'");
        
        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
	
    }
    

}


    // function obtieneCorreo($correo){
    //     try{

        
    //     $conexion= new PDO('mysql:host=localhost;dbname=formularioprimero', 'root', '');
           
    
    //     $res= $conexion->query("select * from prueba1 where correo=$correo");
    //     $registro = $res->fetchAll(PDO::FETCH_ASSOC);
        
    //     return $registro;

           
    //     // var_dump($registro);
    
            
    //     // $res=$conexion->query('select * from users');
    //     // $registro=$res->fetchAll(PDO::FETCH_NUM);
    
    //     // var_dump($registro);
    
    //     // $res=$conexion->query('select * from users');
    //     // $registro=$res->fetchAll(PDO::FETCH_CLASS,"User");
    
    //     // var_dump($registro);
    //     }
    //     catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // } 

   
?>