<?php
require_once("../helpers/ConexionBD.php");
ConexionBD::conecta();

$lista = ConexionBD::obtieneProductosPaginados($_GET['p'],$_GET['t']);

$p=$_GET['p'];

$t=$_GET['t'];

$b=$p+1;

$c=$p-1;

// for ($i=0;$i<count($lista);$i++)
// {
//     echo "Correo : " .$lista[$i]['correo']. " Contraseña : " .$lista[$i]['contrasena']. "<a href='paginacion.php?g=editar'>Editar</a>" ."<br>";
    
   
// }


// if($p==1){

//     echo "<button disabled>1</button>";

//     echo "<a href='paginacion.php?p=2&t=$t'>Siguiente</a>";

   
// }

// else if(ConexionBD::NumPaginas($t)>$p && $p!=1){
  
//     echo "<a href='paginacion.php?p=$c&t=$t'>Atras</a>";
//     echo "<button disabled>$p</button>";
//     echo "<a href='paginacion.php?p=$b&t=$t'>Siguiente</a>";
// }

// else if($p==ConexionBD::NumPaginas($t)){

//     echo "<a href='paginacion.php?p=$c&t=$t'>Atras</a>";
//     echo "<button disabled>$p</button>";
   
// }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table class="default">

    <tr>

        <th>Correo</th>

        <th>Contraseña</th>

      

    </tr>

    <tr>

            <?php
                for ($i=0;$i<count($lista);$i++){
                    echo "<td>".$lista[$i]['correo']."</td>";
                }
                

            ?>

    </tr>

    <tr>
        <?php
            for ($i=0;$i<count($lista);$i++){
                echo "<td>".$lista[$i]['contrasena']."</td>";
            }
        ?>
    </tr>

    </table>

    <?php
        if($p==1){

            echo "<button disabled>1</button>";
        
            echo "<a href='paginacion.php?p=2&t=$t'>Siguiente</a>";
        
           
        }
        
        else if(ConexionBD::NumPaginas($t)>$p && $p!=1){
          
            echo "<a href='paginacion.php?p=$c&t=$t'>Atras</a>";
            echo "<button disabled>$p</button>";
            echo "<a href='paginacion.php?p=$b&t=$t'>Siguiente</a>";
        }
        
        else if($p==ConexionBD::NumPaginas($t)){
        
            echo "<a href='paginacion.php?p=$c&t=$t'>Atras</a>";
            echo "<button disabled>$p</button>";
           
        }
    ?>
</body>
</html>