<?php
include_once "./helpers/Session.php";
 include_once "./helpers/Login.php";
 include_once "./helpers/ConexionBD.php"; 
 include_once "./Clases/Persona.php"; 
 
 Session::init();
            
    if(Login::UsuarioEstaLogueado()){
        
    
    $p=$_GET['p'];
    $cant=$_GET['cant'];

        ConexionBD::conecta();
        $correo=Session::leer('correo');

        $persona=ConexionBD::obtienePersona($correo);
        $gastos=ConexionBD::obtieneGastos($persona->getId(),$cant,$p);

    if(isset($_POST['Actualizar'])){

        if(isset($_POST['Actualizar'])){
            $GastoActualizado=array();
            $GastoActualizado["id"]=$_POST["codigo"];
            $GastoActualizado["concepto"]=$_POST["concepto"];
            $GastoActualizado["fecha"]=$_POST["fecha"];
            $GastoActualizado["cantidad"]=$_POST["cantidad"];


            $DatoGastoEdit=new Gastos($GastoActualizado);
            $DatoIngresoEdit=new Ingresos($GastoActualizado);
            ConexionBD::actualizarDatosGastos($DatoGastoEdit);
            ConexionBD::actualizarDatosIngresos($DatoIngresoEdit);
            header("Location:paginaInicio.php?p=1&t=3");
        }
    
    }
    
        
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

            <a href="paginaInicio.php?p=1&t=3"><img src="./img/R.jpg"/></a>
        </nav>

        <nav id="navIcono">

            <?php
               
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
    <form action="" method="post">
            <table>
                <tbody>
                    <tr>
                        <td>Id_persona</td>
                        <td><input type="text" name="codigo" value="<?php echo $gastos==null?"" :$gastos->getId()?>" readonly></td>
                    </tr>
                    <tr>
                        <td>Concepto</td>
                        <td><input type="text" name="concepto" value="<?php echo $gastos==null?"" :$gastos->getConcepto()?>"></td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td><input type="text" name="fecha" value="<?php echo $gastos==null?"" :$gastos->getFecha()?>"></td>
                    </tr>
                    <tr>
                        <td>Cantidad</td>

                        <td><input type="text" name="cantidad" value="<?php echo $gastos==null?"" :$gastos->getCantidad()?>"></td>
                    </tr>
                </tbody>
            </table>
            <div style="text-align:center; margin-top:10px;">
                <input type="submit" name="Actualizar" value="Actualizar" >
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

