<?php
include_once "./helpers/Session.php";
 include_once "./helpers/Login.php";
 include_once "./helpers/ConexionBD.php"; 
 include_once "./Clases/Persona.php"; 
 include_once "./helpers/Validator.php"; 
 
 Session::init();
            
    if(Login::UsuarioEstaLogueado()){
        
    
    $p=$_GET['p'];

        ConexionBD::conecta();
        $correo=Session::leer('correo');

        $persona=ConexionBD::obtienePersona($correo);
        $gastos=null;

    }

      
    if(isset($_POST['logout'])){

 
        Session::destruir();
       
        header("Location:paginaLogin.php");
    
    }

  if(isset($_POST['Crear'])){

    if($_POST['movimientos']=='ingreso'){

        $GastoActualizado=array();
        $GastoActualizado["id"]=$persona->getId();
        $GastoActualizado["concepto"]=$_POST["concepto"];
        $GastoActualizado["fecha"]=$_POST["fecha"];
        $GastoActualizado["cantidad"]=$_POST["cantidad"];

        
        $DatoIngresoEdit=new Ingresos($GastoActualizado);

        ConexionBD::InsertarDatosIngresos($DatoIngresoEdit);
        header("Location:paginaInicio.php?p=1&t=3");
    }
  }
   

if(isset($_POST['Crear'])){

    if($_POST['movimientos']=='gasto'){

        $GastoActualizado=array();
        $GastoActualizado["id"]=$persona->getId();
        $GastoActualizado["concepto"]=$_POST["concepto"];
        $GastoActualizado["fecha"]=$_POST["fecha"];
        $GastoActualizado["cantidad"]=$_POST["cantidad"];

        
        $DatoGastoEdit=new Gastos($GastoActualizado);
        ConexionBD::InsertarDatosGastos($DatoGastoEdit);
        header("Location:paginaInicio.php?p=1&t=3");
    }
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
        <div id="NuevoFORM">
            <table>
                <tbody>

                    <tr>
                        <td>Concepto</td>
                        <td><input type="text" name="concepto"></td>
                    </tr>
                    <tr>
                        <td>Fecha</td>
                        <td><input type="date" name="fecha"></td>
                    </tr>
                    <tr>
                        <td>Cantidad</td>

                        <td><input type="text" name="cantidad"></td>
                    </tr>
                
                </tbody>
            </table>

            <div id="radios">
                <input type="radio" value="ingreso" name="movimientos">Ingreso</br>
                        
                <input type="radio" value="gasto" name="movimientos">Gasto</br>
            </div>
         </div> 

            <div id="botonCrear" style="text-align:center; margin-top:10px;">
                <input type="submit" name="Crear" value="Crear" >
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

