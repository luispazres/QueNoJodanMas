<?php
  require_once("libs/template_engine.php");


  function run(){
    $data = array();


    session_destroy();/*destruye la informacion registrada de una variable de sesion*/
    header('Location:index.php?page=login2');

    renderizar("CerrarSesion", $data);
  }
  run();
?>
