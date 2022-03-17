<?php

if(isset($_GET['numero1']) && isset($_GET['numero2']) && isset($_GET['operador'])){

    $n1= $_GET['numero1'];

    $n2= $_GET['numero2'];

    $op= $_GET['operador'];

        // %2B -- Codigo suma ASCII

    if($op=='+'){
        $resultado= $n1+$n2;
        echo "El resultado de la suma es " .$resultado;
    }

    else if($op=='-'){

        $resultado= $n1-$n2;
        echo "El resultado de la resta es " .$resultado;
    }

    else if($op=='*'){
        $resultado= $n1*$n2;
        echo "El resultado de la multiplicacion es " .$resultado;
    }

    else if($op=='/'){
        $resultado= $n1/$n2;
        echo "El resultado de la division es " .$resultado;
    }


}


?>