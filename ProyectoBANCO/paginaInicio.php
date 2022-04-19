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

        <!-- <nav>
            <ul>
                
                <li class="categoria">
                    <a href="paginaUsuario.php">Usuarios</a>
                    <ul class="submenu">
                        <li><a href="altaUsuario.php">Alta Usuarios</a></li>
                        <li><a href="eliminarUsuario.php">Eliminacion Usuarios</a></li>
                    </ul>
                </li>
                <li class="categoria">
                    <a href="#">Tematicas</a>
                    <ul class="submenu">
                        <li><a href="altaTematicas.php">Alta temáticas</a></li>
                        <li><a href="eliminaTematicas.php">Elimina Tematicas</a></li>
                    </ul>
                </li>
                <li class="categoria">
                    <a href="#">Preguntas</a>
                    <ul class="submenu">
                        <li><a href="altaPreguntas.php">Alta preguntas</a></li>
                        <li><a href="#">Alta masiva Preguntas</a></li>
                    </ul>
                </li>
                <li class="categoria">
                    <a href="#">Exámenes</a>
                    <ul class="submenu">
                        <li><a href="#">Alta Exámen</a></li>
                        <li><a href="#">Histórico</a></li>
                    </ul>
                </li>
            </ul>
        </nav> -->

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
                    echo "<tr>"."<td>".$lista[$i]['concepto']."</td>"."<td>".$lista[$i]['cantidad *-1']."</td>"."<td>".$lista[$i]['fecha']."</td>"."<td>"."<a href='paginaInicio.php?g=editar'>Editar</a>" ."</td>"."</tr>";
                }
                

            ?>

    </tr>

    </table>
        <div id="pagina">
        <?php
            if($p==1){

                echo "<button disabled>1</button>";
                
                echo "<a href='paginaInicio.php?p=2&t=$t'>Siguiente</a>";
                
                
            }
                
            else if(ConexionBD::NumPaginas($t)>$p && $p!=1){
                
                echo "<a href='paginaInicio.php?p=$c&t=$t'>Atras</a>";
                echo "<button disabled>$p</button>";
                echo "<a href='paginaInicio.php?p=$b&t=$t'>Siguiente</a>";
            }
                
            else if($p==ConexionBD::NumPaginas($t)){
                
                echo "<a href='paginaInicio.php?p=$c&t=$t'>Atras</a>";
                echo "<button disabled>$p</button>";
                
            }
        ?>
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
