<?php
 include_once "./helpers/Session.php";
 include_once "./helpers/Login.php";
 include_once "./helpers/ConexionBD.php"; 
 include_once "./Clases/Persona.php"; 
 include_once "./helpers/Validator.php"; 
 
 Session::init();
            
    if(Login::UsuarioEstaLogueado()){

        ConexionBD::conecta();
        $correo=Session::leer('correo');
    
        $persona=ConexionBD::obtienePersona($correo);
    
        $idPersona=$persona->getId();
        $lista = ConexionBD::obtieneProductosPaginados($_GET['p'],$_GET['t'],$idPersona);

        $p=$_GET['p'];
        
        $t=$_GET['t'];
        
        $b=$p+1;
        
        $c=$p-1;
     

}
else{
    header("Location:paginaLogin.php");
}

if(isset($_POST['logout'])){

 
    Session::destruir();
   
    header("Location:paginaLogin.php");

}

if(isset($_POST['nuevo'])){

    header("Location:paginaNuevoMov.php?p=1&t=3");

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario</title>
    <script src="https://kit.fontawesome.com/f4af5b899a.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/main.css">
   

</head>
<body>
    <header>
        <nav id="imgPrincipal">
            <a href="paginaInicio.php?p=1&t=3"><img src="./img/R.jpg"/></a>
        </nav>

        <nav id="navIcono">

            <?php
               
            //    $clase->setNombre( $listado['nombre']);
            // foreach($listado as $clase => $nombre) {
            //     echo "$clase => $nombre\n";
            // }
                            // setNombre($listado);

                $soloNombre=ConexionBD::obtieneNOMBRECABECERA($correo);
                $soloApellidos=ConexionBD::obtieneApellidosCABECERA($correo);
                foreach($soloNombre as $nombre => $nombre1){
                    echo "$nombre1 ";
                }
                foreach($soloApellidos as $nombre => $nombre2){
                    echo "$nombre2";
                }
             
                
            
    
            ?>
        
       
        </nav>

        <?php
        
        //MUESTRA TOTAL INGRESOS -GASTOS

                $GASTOS=implode(" ",ConexionBD::CalculaGastos($idPersona));
             
                $Ingresos=implode(" ",ConexionBD::CalculaIngresos($idPersona));
          


                $BUENGASTO= intval($GASTOS);
                $BUENINGRESO= intval($Ingresos);

                $DineroTotal=$BUENGASTO+$BUENINGRESO;

                echo "<p id='DineroTotal'>"."TOTAL: " .$DineroTotal. "€"."</p>";
            ?>

        <form action='' method='post'>
            <input id="logout" type='submit' name='logout' value='Cerrar Sesion'/>

        </form>

    </header>

<article>
 
<table style='width:90%;' id="tabla">
 
    <thead>

        <tr>

            <td>Concepto</td>

            <td>Movimientos</td>

            <td>Fecha</td>

            <td>Accion</td>

        </tr>

    </thead>
    <tr>

            <?php
                for ($i=0;$i<count($lista);$i++){

                    echo "<tr>"."<td>".$lista[$i]['concepto']."</td>"."<td>".$lista[$i]['cantidad']."</td>"."<td>".$lista[$i]['fecha']."</td>"."<td>".
                    "<a href=paginaEditarMov.php?p=".$p."&cant=".$lista[$i]['cantidad']."&id_persona=".$idPersona."><button id='editar' name='editar'>Editar</button></a>
                    <a href=paginaBorrar.php?p=".$p."&cant=".$lista[$i]['cantidad']."&id_persona=".$idPersona."><button>Borrar</button></a>" ."</td>"."</tr>";
                    

                    // <a href=""><button>Editar</button></a> 
                }
               
                            

            ?>
           
    </tr>

    </table>
    
        <div id="pagina">
        
        <?php

         $NumeroPaginas= ConexionBD::NumPaginas($t,$idPersona);

            if($NumeroPaginas==$p){

                echo "<button disabled>$p</button>";
                echo "<a href='paginaInicio.php?p=$c&t=$t'>Atras</a>"."</br>";
                // echo "<a href='paginaInicio.php?p=2&t=$t'>Siguiente</a>";
                
            
            }

            else if($p==1){

                echo "<button disabled>1</button>"."</br>";
                
                echo "<a href='paginaInicio.php?p=$b&t=$t'>Siguiente</a>";
                
                
            }
                
            
           else if($p<$NumeroPaginas && $b){
                
                echo "<button disabled>$p</button>";
                echo "<a href='paginaInicio.php?p=$b&t=$t'>Siguiente</a>"."</br>";
                echo "<a href='paginaInicio.php?p=$c&t=$t'>Atras</a>"."</br>";
               
               
               
            }
                
        ?>
     </div>

     <div id="botonNuevo">  
     <form action='' method='post'>

            <input id="nuevo" type='submit' name='nuevo' value='Nuevo'/>

        </form>
     </div>

            
            
</article>

    <footer>
        <div class="continente">
    <div class="cajaizq">
        
</div>

    <div class="cajacent">
        
       <!-- <a href="">HOLA<input type='submit' name='elimina' value=''/></a> -->
    </div>

    <div class="cajader">

    
    </div>
</div> 
    </footer>
</body>
</html>
