<?php
require_once("../helpers/ConexionBD.php");
ConexionBD::conecta();
$lista = ConexionBD::obtieneProductosPaginados(1,6);
for ($i=0;$i<count($lista);$i++)
{
    echo $lista[$i]['correo']. " " .$lista[$i]['contrasena']. "<br>";
 
   
}


?>