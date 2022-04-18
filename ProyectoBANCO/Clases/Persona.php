<?php
class Persona{
    protected $nombre;
    protected $apellidos;
    protected $correo;
    protected $contraseña;

    public function getNombre() {return $this->nombre; }
    public function getApellidos() {return $this->apellidos; }
    public function getCorreo() {return $this->correo; }
    public function getContraseña() {return $this->contraseña; }

    
    public function __construct($row) {
        $this->nombre = $row['nombre'];
        $this->apellidos = $row['apellidos'];
        $this->correo = $row['correo'];
        $this->contraseña = $row['contrasena'];
    
    }
}
?>