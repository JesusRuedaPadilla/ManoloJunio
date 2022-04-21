<?php
 include_once "./Clases/Persona.php"; 

class ConexionBD{

    private static $con;

        public static function conecta(){
    
            try {
                self::$con= new PDO('mysql:host=localhost;dbname=banco', 'root', '');
                self::$con->query("SET NAMES utf8");
                return true;
            } catch (\Throwable $th) {
                return false;
            }
               
               
        }

    public static function obtienePersona($correo)  
    {
        $persona=null;

        $res= self::$con->query("select * from personas where correo ='$correo'");
        $registros=$res->fetch();
        if($registros!=false){
            $persona=new Persona(array('id'=>$registros['id'],'nombre'=>$registros['nombre'],'apellidos'=>$registros['apellidos'],
                                    'correo'=>$registros['correo'],'contrasena'=>$registros['contrasena']));            
            return $persona;
        }else
        {
            return $persona;
        }
	
    }
    
    public static function existeusuario($correo,$contraseña)
    {

        $sql="SELECT * FROM personas WHERE correo like '$correo' and contrasena like '$contraseña'"; 
        $resultado = self::$con->query($sql);
        $count = $resultado->rowCount();
        return $count==1;
                     
    }
    
    public static function InsertaDatos($correo,$contraseña)
    {
        
        $sql="INSERT INTO `personas` (correo,contrasena,foto) VALUES ('$correo','$contraseña','$foto')";
        $res= self::$con->exec($sql);
         
    }

    public static function obtieneProductosPaginados(int $pagina, int $filas,$id):array
    {
        $registros = array();
        $res = self::$con->query("(select `concepto`, cantidad *-1 AS cantidad, `fecha` from gastos where id_persona like '$id') UNION (select `concepto`, `cantidad` , `fecha` from ingresos where id_persona like '$id')");
        $registros =$res->fetchAll();
        $total = count($registros);
        $paginas = ceil($total /$filas);
        $registros = array(); 
        if ($pagina <= $paginas)
        {
            $inicio = ($pagina-1) * $filas;
            $res= self::$con->query("(select `concepto`, cantidad *-1 AS cantidad, `fecha` from gastos where id_persona like '$id') UNION (select `concepto`, `cantidad` , `fecha` from ingresos where id_persona like '$id') limit $inicio, $filas");
            $registros = $res->fetchAll(PDO::FETCH_ASSOC);
        }
        return $registros;
    }
    
    public static function obtieneNOMBRECABECERA($correo)
    {

        $res= self::$con->query("select `nombre` from personas where correo ='$correo'");

        $registro = $res->fetchAll(PDO::FETCH_COLUMN);

        return $registro;
    }

     
    public static function obtieneApellidosCABECERA($correo)
    {

        $res= self::$con->query("select `apellidos` from personas where correo ='$correo'");

        $registro = $res->fetchAll(PDO::FETCH_COLUMN);

        return $registro;
    }


    public static function NumPaginas(int $filas,$id):int
    {
        $registros = array();
        $res = self::$con->query("(select `concepto`, cantidad *-1 AS cantidad, `fecha` from gastos where id_persona like '$id') UNION (select `concepto`, `cantidad` , `fecha` from ingresos where id_persona like '$id')");
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