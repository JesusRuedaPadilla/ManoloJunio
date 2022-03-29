<?php

class User {
    protected $correo;

    protected $contraseña;

    
    public function getcorreo() {return $this->correo;}
   
    public function getcontrasena() {return $this->contraseña;}
    
    
    public function __construct($row) {
        $this->correo = $row['correo'];
        $this->contraseña= $row['contrasena'];
        
    }
}
// Ejercicio el formulario de login debe admitir correo y contraseña de solo de 8 a 12 digitos, al menos un signo de puntuacion una mayuscula y un numero
// Validamos el formulario, en la base de datos hacemos unn select de usuario y contraseña y decismo que esta conectado si esta bien o no conectado
?>
