<?php

class ConexionBD{

    private static $con;

        public static function conecta(){
    
            try {
                self::$con= new PDO('mysql:host=localhost;dbname=viajes', 'root', '');
                self::$con->query("SET NAMES utf8");
                return true;
            } catch (\Throwable $th) {
                return false;
            }
               
               
        }



    public static function obtieneTodosDatos($correo)  
    {

        $res= self::$con->query("SELECT a.*, e.*,d.*,c.descripcion as Descrip,c.fecha_firma,s.*
        FROM alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e
        WHERE (a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede)
        AND (a.id_usuario = '$correo') ORDER BY e.nombre_empresa ,c.fecha_firma,s.id_sede,a.id_alumno_detalle_convenio");

                    
        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
      
    
          return $registro;
        }


    public static function obtieneVisitas($id_alumno){

        $res= self::$con->query("SELECT v.* FROM visita v WHERE id_alumno_detalle_convenio='$id_alumno'");

        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }
        
            
    public static function existeusuario($correo,$contraseña)
    {

        $sql="SELECT * FROM usuario WHERE id_usuario like '$correo' and contrasena like '$contraseña'"; 
        $resultado = self::$con->query($sql);
        $count = $resultado->rowCount();
        return $count==1;
                     
    }
    

    public static function BorrarVisita($id_visita){
       

        $res = self::$con->query("DELETE FROM `visita` WHERE `id_visita`='$id_visita'");
        
      
    }

    public static function InsertarVisitas($fecha_inicio,$hora_inicio,$fecha_fin,$hora_fin,$id_alumno_detalle_convenio){
        
        $res = self::$con->query("INSERT INTO `visita` (`id_visita`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `id_alumno_detalle_convenio`, `dieta`) VALUES (NULL, '$fecha_inicio', '$hora_inicio', '$fecha_fin', '$hora_fin', '$id_alumno_detalle_convenio', '0')");
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

   
?>