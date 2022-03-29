<?php
//var_dump($_FILES);
if(isset($_FILES['fichero']))
{
    move_uploaded_file($_FILES['fichero']['tmp_name'],"./imagenes/imagen1");
}

?>
    <form action='' method='post' enctype='multipart/form-data'>
    Selecciona fichero:
    <br>
    <input type='file' name='fichero'>
    <br>
    <input type='submit' value='Enviar'>
    </form>
