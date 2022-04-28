<?php

$obj=new stdClass();
$obj->success=true;
if(isset($_POST["user"])){
    $obj->user=$_POST["user"];
}
$obj->desplazamientos=[1,2,3,4];
   echo json_encode($obj);
?>
