<?php

if(isset($_GET['numero1'])){

    $n1= $_GET['numero1'];

    $resultado= $n1 * $n1;
    echo "El resultado de la multiplicacion es " .$resultado;
}


?>