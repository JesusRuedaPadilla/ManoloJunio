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

    
    public static function obtieneProfesores(){

        $res= self::$con->query("SELECT `id_usuario`,`nombre`,apellidos,rol FROM usuario");

        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }

    public static function obtieneVisitas($id_alumno){

        $res= self::$con->query("SELECT v.* FROM visita v WHERE id_alumno_detalle_convenio='$id_alumno'");

        $registro = $res->fetchAll(PDO::FETCH_ASSOC);
        return $registro;
    }
        
       
    public static function existeAdmin($correo,$contraseña)
    {

        $sql="SELECT * FROM usuario WHERE id_usuario like '$correo' and contrasena like '$contraseña' and rol like 'administrador'"; 
        $resultado = self::$con->query($sql);
        $count = $resultado->rowCount();
        return $count;
                     
    }

    public static function existeProfesor($correo,$contraseña)
    {

        $sql="SELECT * FROM usuario WHERE id_usuario like '$correo' and contrasena like '$contraseña' and rol like 'profesor'"; 
        $resultado = self::$con->query($sql);
        $count = $resultado->rowCount();
        return $count==1;
                     
    }
    
    public static function ActualizaContraseña($id_usuario,$contraseña){
       

        $res = self::$con->query("UPDATE `usuario` SET `contrasena` = '$contraseña' where `id_usuario`='$id_usuario'");
        
        if($res!=false){
            return true;
        }
        else{
            return false;
        }
        
      
    }

    public static function dameContraseña($id_usuario){
       
        $id_usuario;
        $res = self::$con->query("SELECT contrasena FROM usuario WHERE id_usuario like '$id_usuario'");
        
        $registro = $res->fetch(PDO::FETCH_ASSOC);
        return $registro;
      
    }

    
    public static function dameVisitaSeleccionada($id_visita){
       
        $id_visita;
        $res = self::$con->query("SELECT * FROM visita WHERE id_visita like '$id_visita'");
        
        $registro = $res->fetch(PDO::FETCH_ASSOC);
        return $registro;
      
    }


    public static function BorrarVisita($id_visita){
       

        $res = self::$con->query("DELETE FROM `visita` WHERE `id_visita`='$id_visita'");
        
      
    }

    public static function ActualizaVisitas($Visita){
       
        $fecha_inicio=$Visita[0];
        $hora_inicio=$Visita[1];
        $fecha_fin=$Visita[2];
        $hora_fin=$Visita[3];
        $id_alumno_detalle_convenio=$Visita[4];
        $id_visita=$Visita[5];

        $res = self::$con->query("UPDATE `visita` SET `fecha_inicio` = '$fecha_inicio', `hora_inicio` = '$hora_inicio', `fecha_fin` = '$fecha_fin', `hora_fin` = '$hora_fin' WHERE `visita`.`id_visita` = '$id_visita' AND `visita`.`id_alumno_detalle_convenio` = '$id_alumno_detalle_convenio'");
        
        if($res!=false){
            return true;
        }
        else{
            return false;
        }
        
      
    }

    public static function ActualizaDietas($id_visita){
       
    
        $res = self::$con->query("UPDATE `visita` SET `dieta` = '1' WHERE `id_visita` = '$id_visita'");
        
        if($res!=false){
            return true;
        }
        else{
            return false;
        }
        
      
    }

    public static function ActualizaDietasACero($id_visita){
       
    
        $res = self::$con->query("UPDATE `visita` SET `dieta` = '0' WHERE `id_visita` = '$id_visita'");
        
        if($res!=false){
            return true;
        }
        else{
            return false;
        }
        
      
    }


    public static function InsertarVisitas($Visita){
        $fecha_inicio=$Visita[0];
        $hora_inicio=$Visita[1];
        $fecha_fin=$Visita[2];
        $hora_fin=$Visita[3];
        $id_alumno_detalle_convenio=$Visita[4];

        $res = self::$con->query("INSERT INTO `visita` (`id_visita`, `fecha_inicio`, `hora_inicio`, `fecha_fin`, `hora_fin`, `id_alumno_detalle_convenio`, `dieta`) VALUES (NULL, '$fecha_inicio', '$hora_inicio', '$fecha_fin', '$hora_fin', '$id_alumno_detalle_convenio', '0')");
        $res2 = self::$con->query("COMMIT");

        $res3= self::$con->query("SELECT MAX(`id_visita`)as `id_visita`  FROM visita");
        // $res3= self::$con->query("SELECT `visita` FROM visita");
        $registros = $res3->fetchAll(PDO::FETCH_ASSOC);
        return $registros;
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