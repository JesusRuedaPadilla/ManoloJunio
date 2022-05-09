<?php
//  include_once "../helpers/ConexionBD.php"; 
//  include_once "../helpers/Login.php"; 
//  include_once "../helpers/Session.php"; 
//  include_once "../paginaInicio.php";
//  include_once "../paginaLogin.php";  

class Sede{
    
    // public $id_sede;
    public $descripcion;
    public $direccion;
    public $codigo_postal;
    public $localidad;
    public $municipio;
    public $provincia;
    // public $id_empresa;
 

    public function getDescripcion() {return $this->descripcion; }
    public function getDireccion() {return $this->direccion; }
    public function getCodigo_postal() {return $this->codigo_postal; }
    public function getLocalidad() {return $this->localidad; }
    // public function getId_sede() {return $this->id_sede; }
    public function getMunicipio() {return $this->municipio; }
    public function getProvincia() {return $this->provincia; }
    

   

    public function __construct($row) {

        // $this->id_sede = $row['id_sede'];
        $this->descripcion = $row['descripcion'];
        $this->direccion = $row['direccion'];
        $this->codigo_postal = $row['codigo_postal'];
        $this->localidad = $row['localidad'];
        $this->municipio = $row['municipio'];
        $this->provincia = $row['provincia'];
  

    }
}
?>