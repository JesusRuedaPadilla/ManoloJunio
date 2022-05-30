<?php
// require_once "User.php";
require_once "Session.php";
require_once "ConexionBD.php";
class Login
{
    public static function Identifica(string $usuario,string $contrasena,bool $recuerdame)
    {
        if(self::Existeusuario($usuario,$contrasena))
        {
            Session::iniciar();
            Session::escribir('login',$usuario); 
            return true;
        }
        return false;
    }

    private static function ExisteUsuario(string $usuario,string $password=null)
    {
        DB::conecta();
       return DB::existeusuario($usuario,$password);
    }

    public static function UsuarioEstaLogueado()
    {
        if(Session::leer('correo') && Session::leer('contrasena'))
        {
            return true;
        }
        return false;
    }

    public static function AdminLogueado()
    {
        if(Session::leer('correo') && Session::leer('contrasena') && Session::leer('rol'))
        {
            return true;
        }
        return false;
    }
}

?>