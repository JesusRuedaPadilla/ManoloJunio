<?php
 include_once "./Clases/Persona.php"; 
 include_once "./Clases/Gastos.php"; 
 include_once "./Clases/Ingresos.php"; 

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

    public static function obtieneGastos($id_persona,$cantidad)  
    {
        $gastos=null;
        $cantidad=$cantidad*-1;
        $res= self::$con->query("select * from gastos where id_persona ='$id_persona' AND cantidad='$cantidad'");
        $registros=$res->fetch();
        
        if($registros!=false){
            $gastos=new Gastos(array('id'=>$registros['id'],'concepto'=>$registros['concepto'],'fecha'=>$registros['fecha'],
                                    'cantidad'=>$registros['cantidad']));            
            return $gastos;
        }

        else
        {
            $cantidad=$cantidad*-1;
            $res= self::$con->query("select * from ingresos where id_persona ='$id_persona' AND cantidad='$cantidad'");
            $registros=$res->fetch();

            $ingresos=new Ingresos(array('id'=>$registros['id'],'concepto'=>$registros['concepto'],'fecha'=>$registros['fecha'],
            'cantidad'=>$registros['cantidad']));     

            return $ingresos;
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
        $res = self::$con->query("(select `id`,`concepto`, cantidad *-1 AS cantidad, `fecha` from gastos where id_persona like '$id') UNION (select `id`, `concepto`, `cantidad` , `fecha` from ingresos where id_persona like '$id') ORDER BY `fecha` ,`id`");
        $registros =$res->fetchAll();
        $total = count($registros);
        $paginas = ceil($total /$filas);
        $registros = array(); 
        if ($pagina <= $paginas)
        {
            $inicio = ($pagina-1) * $filas;
            $res= self::$con->query("(select `id`,`concepto`, cantidad *-1 AS cantidad, `fecha` from gastos where id_persona like '$id') UNION (select `id`,`concepto`, `cantidad` , `fecha` from ingresos where id_persona like '$id')  ORDER BY `fecha` ,`id` limit $inicio, $filas");
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

     
    public static function CalculaGastos($id)
    {
  
        $res= self::$con->query("(select SUM(cantidad *-1) AS cantidad from gastos where id_persona like '$id')");

        $registro = $res->fetchAll(PDO::FETCH_COLUMN);

        return $registro;
    }

     
    public static function CalculaIngresos($id)
    {
  
        $res= self::$con->query("(select SUM(`cantidad`) from ingresos where id_persona like '$id')");

        $registro = $res->fetchAll(PDO::FETCH_COLUMN);

        return $registro;
    }
   
    public static function actualizarDatosGastos($gastos){
        $codigo=$gastos->getId();
        $concepto=$gastos->getConcepto();
        $fecha=$gastos->getFecha();
        $cantidad=$gastos->getCantidad();
        $res = self::$con->query("update gastos set concepto='$concepto', fecha='$fecha', cantidad='$cantidad' where id='$codigo'");
    }

    public static function actualizarDatosIngresos($ingresos){
        $codigo=$ingresos->getId();
        $concepto=$ingresos->getConcepto();
        $fecha=$ingresos->getFecha();
        $cantidad=$ingresos->getCantidad();
        $res = self::$con->query("update ingresos set concepto='$concepto', fecha='$fecha', cantidad='$cantidad' where id='$codigo'");
    }

    public static function BorrarDatosIngresos($ingresos){
        $concepto=$ingresos->getConcepto();
        $codigo=$ingresos->getId();

        $res = self::$con->query("delete from ingresos where id='$codigo' AND concepto='$concepto'");
    }

    public static function BorrarDatosGastos($gastos){
        $concepto=$gastos->getConcepto();
        $codigo=$gastos->getId();

        $res = self::$con->query("delete from gastos where id='$codigo' AND concepto='$concepto'");
    }

    public static function InsertarDatosIngresos($ingresos){
        
        $concepto=$ingresos->getConcepto();
        $cantidad=$ingresos->getCantidad();
        $fecha=$ingresos->getFecha();
        $codigo=$ingresos->getId();

        $res = self::$con->query("INSERT INTO `ingresos`(`id`, `id_persona`, `concepto`, `fecha`, `cantidad`) VALUES (NULL,'$codigo','$concepto','$fecha','$cantidad')");
        
    }

    public static function InsertarDatosGastos($gastos){
        
        $concepto=$gastos->getConcepto();
        $cantidad=$gastos->getCantidad();
        $fecha=$gastos->getFecha();
        $codigo=$gastos->getId();

        $res = self::$con->query("INSERT INTO `gastos`(`id`, `id_persona`, `concepto`, `fecha`, `cantidad`) VALUES (NULL,'$codigo','$concepto','$fecha','$cantidad')");
    }

}

   
?>