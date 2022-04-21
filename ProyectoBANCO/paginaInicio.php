<?php
 include_once "./helpers/Session.php";
 include_once "./helpers/Login.php";
 include_once "./helpers/ConexionBD.php"; 
 include_once "./Clases/Persona.php"; 
 
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

    header("Location:a.php?p=1&t=3");

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
           <img src="./img/R.jpg" alt="">
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
                    echo "$nombre1</br>";
                }
                foreach($soloApellidos as $nombre => $nombre2){
                    echo "$nombre2";
                }
             
            ?>
        
       
        </nav>
        <form action='' method='post'>
            <input id="logout" type='submit' name='logout' value='Cerrar Sesion'/>

        </form>

    </header>

<article>
 
<table style='text-align:center; margin: 0 auto; width:50%;' cellspacing=5px; id="tabla">
 
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
                    echo "<tr>"."<td>".$lista[$i]['concepto']."</td>"."<td>".$lista[$i]['cantidad']."</td>"."<td>".$lista[$i]['fecha']."</td>"."<td>"."<a href='paginaInicio.php?g=editar'>Editar</a>" ."</td>"."</tr>";
                
                }
            
                // for($i=0;$i<=count($lista);$i++){

                //     $posible=$lista[$i]['cantidad'];
                // $suma=0;
                // $a=1;

                // if($i>=count($lista)){
                //     $i=count($lista);
                //     $a=0;

                //     if ($a==0){
                //         echo "<p id='sumaTOTAL'>".$sumatoria."</p>";
                //         break;
                //       }
                //   }
                //    if ($a==1){
                //     $i= $i+1;

                //     $suma= $lista[$i]['cantidad'];
                //      $sumatoria=$posible+$suma;
                //      $i=$i-1;
                //   }
                  
                // }
              
                
               
              
            ?>

    </tr>

    </table>

        <div id="pagina">
        <?php
          
            if(ConexionBD::NumPaginas($t,$idPersona)==$p && $t<ConexionBD::NumPaginas($t,$idPersona) && $p==1){

                echo "<button disabled>1</button>";
                
                // echo "<a href='paginaInicio.php?p=2&t=$t'>Siguiente</a>";
                
                
            }

            if($p<ConexionBD::NumPaginas($t,$idPersona) && $p==1){

                echo "<button disabled>1</button>"."</br>";
                
                echo "<a href='paginaInicio.php?p=$b&t=$t'>Siguiente</a>";
                
                
            }
                
            
           if($p<ConexionBD::NumPaginas($t,$idPersona) && ConexionBD::NumPaginas($t,$idPersona)>$t && $p!=1){
                
                echo "<button disabled>$p</button>";
                echo "<a href='paginaInicio.php?p=$b&t=$t'>Siguiente</a>"."</br>";
                echo "<a href='paginaInicio.php?p=$c&t=$t'>Atras</a>"."</br>";
               
               
               
            }
                
            if($p==ConexionBD::NumPaginas($t,$idPersona)){

                echo "<button disabled>$p</button>"."</br>";
                echo "<a href='paginaInicio.php?p=$c&t=$t'>Atras</a>";
               
                
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
       
    </div>

    <div class="cajader">

    </div>
</div> 
    </footer>
</body>
</html>
