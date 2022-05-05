<?php
//  include_once "../helpers/ConexionBD.php"; 
//  include_once "../helpers/Login.php"; 
//  include_once "../helpers/Session.php"; 
//  include_once "../paginaInicio.php";
//  include_once "../paginaLogin.php";  

class Persona{
    
    public $id_usuario;
    public $nombre;
    public $apellidos;
    public $rol;
    public $contrasena;
 

    public function getNombre() {return $this->nombre; }
    public function getApellidos() {return $this->apellidos; }
    public function getRol() {return $this->rol; }
    public function getContraseña() {return $this->contrasena; }
    public function getId() {return $this->id_usuario; }


    public function __construct($row) {

        $this->id_usuario = $row['id_usuario'];
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->contrasena = $row['contrasena'];
        $this->rol = $row['rol'];
  

    }
}
?>