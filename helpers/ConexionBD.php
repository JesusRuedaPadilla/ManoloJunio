<?php
// require_once ('../User.php');

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
    
    
    public static function InsertaDatos($correo,$contraseña,$foto)
    {
        // echo "correo:".$correo."<br>"."nombre:".$nombre."<br>"."apellidos:".$apellidos."<br>"."fecha:".$fecha_nac;
        
        $sql="INSERT INTO `prueba1` (correo,contrasena,foto) VALUES ('$correo','$contraseña','$foto')";
        $res= self::$con->exec($sql);
    
        // if($foto!=""){
        //     $res->bindParam(1,$correo);
        //     $res->bindParam(2,$contraseña);
        //     $res->bindParam(3,$foto);            
        //     $res->execute();
        // }        
    }

    public static function obtieneProductosPaginados(int $pagina, int $filas):array
    {
        $registros = array();
        $res = self::$con->query("select * from prueba1");
        $registros =$res->fetchAll();
        $total = count($registros);
        $paginas = ceil($total /$filas);
        $registros = array();
        if ($pagina <= $paginas)
        {
            $inicio = ($pagina-1) * $filas;
            $res= self::$con->query("select * from prueba1 limit $inicio, $filas");
            $registros = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        return $registros;
    }

    public static function NumPaginas(int $filas):int
    {
        $registros = array();
        $res = self::$con->query("select * from prueba1");
        $registros =$res->fetchAll();
        $total = count($registros);
        $paginas = ceil($total /$filas);
    
        return $paginas;
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