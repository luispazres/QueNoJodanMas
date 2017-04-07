<?php
require_once("libs/template_engine.php");
require_once("models/contratos.model.php");


function run(){
    $datos= "";
    $datos=$_GET["DocumentoDireccion"];

   renderizarVista("vista", array('DocumentoDireccion' =>$datos  ));
}

  run();
 ?>
