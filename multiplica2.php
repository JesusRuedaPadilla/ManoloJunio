<?php

if(isset($_GET['numero1']) && isset($_GET['numero2'])){

    $n1= $_GET['numero1'];

    $n2= $_GET['numero2'];

    $resultado= $n1 * $n2;
    echo "El resultado de la multiplicacion es " .$resultado;
}


?>