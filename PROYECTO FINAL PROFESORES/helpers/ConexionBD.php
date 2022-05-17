<?php
 include_once "../Clases/Persona.php"; 
 include_once "../Clases/Sede.php"; 
 include_once "../Clases/Gastos.php"; 
 include_once "../Clases/Ingresos.php"; 

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

    public static function obtienePersona($correo)  
    {
        $persona=null;

        $res= self::$con->query("select * from usuario where id_usuario ='$correo'");
        $registros=$res->fetch();
        if($registros!=false){

            $persona=new Persona(array('id_usuario'=>$registros['id_usuario'],'nombre'=>$registros['nombre'],'apellidos'=>$registros['apellidos'],
                                    'contrasena'=>$registros['contrasena'],'rol'=>$registros['rol']));    
            // $funciona=json_encode($persona->getId());
            //  echo $funciona;                               
            return $persona;
        }else
        {
            return $persona;
        }
	
    }

    public static function obtieneTodosDatos($correo)  
    {
            // Funciona 
            
    //     SELECT *
    // FROM usuario u, alumno_detalle_convenio a, detalle_convenio d
    // WHERE (u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio)
    // AND (u.id_usuario = 'jve')


//     SELECT *
// FROM usuario u, alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e, visita v
// WHERE (u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede AND v.id_alumno_detalle_convenio=a.id_alumno_detalle_convenio)
// AND (u.id_usuario = '$correo')


// SELECT u.*,a.nombre_alumno,d.fecha_inicio,d.fecha_fin,c.descripcion,c.fecha_firma,s.descripcion,s.direccion,s.codigo_postal,s.localidad,s.municipio,s.provincia,e.nombre_empresa,v.fecha_inicio,v.hora_inicio,v.fecha_fin,v.hora_fin
// FROM usuario u, alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e, visita v
// WHERE ((u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede AND v.id_alumno_detalle_convenio=a.id_alumno_detalle_convenio) OR (
// u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede)) AND (u.id_usuario = 'svl')


// SELECT u.*,a.nombre_alumno,d.fecha_inicio,d.fecha_fin,c.descripcion,c.fecha_firma,s.descripcion as Des ,s.direccion,s.codigo_postal,s.localidad,s.municipio,s.provincia,e.nombre_empresa
//                                 FROM usuario u, alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e
//                                 WHERE (u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede)
//                                 AND (u.id_usuario = 'svl') ORDER BY nombre_empresa, fecha_firma, Des, nombre_alumno

        $persona=null;

        $res= self::$con->query("SELECT a.*, e.*,d.*,c.descripcion as Descrip,c.fecha_firma,s.*
        FROM alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e
        WHERE (a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede)
        AND (a.id_usuario = '$correo') ORDER BY e.nombre_empresa ,c.fecha_firma,s.id_sede,a.id_alumno_detalle_convenio");
//fecha_firma,sede,y alumno

// SELECT e.nombre_empresa, c.id_convenio, c.descripcion AS desconvenio, c.fecha_firma, dc.id_detalle_convenio, dc.fecha_Inicio, dc.fecha_fin, s.descripcion, adc.id_alumno_detalle_convenio, adc.nombre_alumno 
// FROM usuario u JOIN alumno_detalle_convenio adc JOIN `detalle_convenio` dc JOIN convenio c JOIN sede s JOIN empresa e 
// ON u.id_usuario=adc.id_usuario AND adc.id_detalle_convenio=dc.id_detalle_convenio AND dc.id_convenio=c.id_convenio AND dc.id_sede=s.id_sede AND s.id_empresa=e.id_empresa WHERE u.id_usuario='$correo'
// ORDER BY e.nombre_empresa, c.descripcion, s.descripcion

        // $res2=self::$con->query("SELECT u.*,a.nombre_alumno,d.fecha_inicio,d.fecha_fin,c.descripcion,c.fecha_firma,s.descripcion,s.direccion,s.codigo_postal,s.localidad,s.municipio,s.provincia,e.nombre_empresa
        //                         FROM usuario u, alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e
        //                         WHERE (u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede)
        //                         AND (u.id_usuario = '$correo')");
                    
        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
      
    

        // $registro2 = $res2->fetchAll(PDO::FETCH_ASSOC);

        // $registroFinal=$registro + $registro2;

        // $SI=count($registroFinal);
         
           
        // $obj=new stdClass();
        //     for($i=0;$i<$SI-1;$i++){
        //         $sede=null;
        //         for($i=0;$i<$SI;$i++){
                   
                  
        //             $obj->success=true;

        //             $sede[$i]=new Sede(array('descripcion'=>$registroFinal[$i]['descripcion'],'direccion'=> $registroFinal[$i]['direccion'],
        //             'codigo_postal'=> $registroFinal[$i]['codigo_postal'],'localidad'=> $registroFinal[$i]['localidad'],'municipio'=> $registroFinal[$i]['municipio'],'provincia'=> $registroFinal[$i]['provincia']));            
        //             $obj->user->sede[$i]=$sede[$i];
        //         }
             
        //     }

          return $registro;
        }

        // if($registro==false){
        //     $res= self::$con->query("SELECT u.*,a.nombre_alumno,d.fecha_inicio,d.fecha_fin,c.descripcion,c.fecha_firma,s.descripcion,s.direccion,s.codigo_postal,s.localidad,s.municipio,s.provincia,e.nombre_empresa
        //     FROM usuario u, alumno_detalle_convenio a, detalle_convenio d, convenio c, sede s, empresa e
        //             WHERE (u.id_usuario = a.id_usuario AND a.id_detalle_convenio = d.id_detalle_convenio AND d.id_convenio=c.id_convenio AND e.id_empresa=s.id_empresa AND d.id_sede=s.id_sede)
        //             AND (u.id_usuario = '$correo')");

        //  $registro = $res->fetchAll(PDO::FETCH_OBJ);
        
        // }
        // return $sede;
        // return $registro + $registro2;

    public static function obtieneVisitas($id_alumno){

        $res= self::$con->query("SELECT v.* FROM visita v WHERE id_alumno_detalle_convenio='$id_alumno'");

        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }

    // public static function obtieneEmpresa($id_empresa){

    //     $res= self::$con->query("SELECT e.* FROM empresa e  WHERE id_empresa='$id_empresa'");

    //     $registro = $res->fetchAll(PDO::FETCH_ASSOC);
    //     return $registro;
    // }

    
    // public static function obtieneDatosPorEmpresa($correo){

    //     $res= self::$con->query("SELECT e.nombre_empresa, c.id_convenio, c.descripcion AS desconvenio, c.fecha_firma, dc.id_detalle_convenio, dc.fecha_Inicio, dc.fecha_fin, s.descripcion, adc.id_alumno_detalle_convenio, adc.nombre_alumno 
    //     FROM usuario u JOIN alumno_detalle_convenio adc JOIN `detalle_convenio` dc JOIN convenio c JOIN sede s JOIN empresa e 
    //     ON u.id_usuario=adc.id_usuario AND adc.id_detalle_convenio=dc.id_detalle_convenio AND dc.id_convenio=c.id_convenio AND dc.id_sede=s.id_sede AND s.id_empresa=e.id_empresa WHERE u.id_usuario='$correo'
    //     ORDER BY e.nombre_empresa, c.descripcion, s.descripcion");

    //     $registro = $res->fetchAll(PDO::FETCH_ASSOC);
    //     return $registro;
    // }
        
            
    public static function existeusuario($correo,$contraseña)
    {

        $sql="SELECT * FROM usuario WHERE id_usuario like '$correo' and contrasena like '$contraseña'"; 
        $resultado = self::$con->query($sql);
        $count = $resultado->rowCount();
        return $count==1;
                     
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