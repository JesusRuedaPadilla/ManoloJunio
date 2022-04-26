<?php
//  include_once "../helpers/ConexionBD.php"; 
//  include_once "../helpers/Login.php"; 
//  include_once "../helpers/Session.php"; 
//  include_once "../paginaInicio.php";
//  include_once "../paginaLogin.php";  

class Ingresos{
    
    protected $id;
    protected $concepto;
    protected $fecha;
    protected $cantidad;
 

    public function getConcepto() {return $this->concepto; }
    public function getFecha() {return $this->fecha; }
    public function getCantidad() {return $this->cantidad; }
    public function getId() {return $this->id; }
    public function getP() {return $this->p; }
    public function getT() {return $this->t; }

    public function __construct($row) {
        $this->id = $row['id'];
        $this->concepto = $row['concepto'];
        $this->fecha = $row['fecha'];
        $this->cantidad = $row['cantidad'];
  

    }
}
?>