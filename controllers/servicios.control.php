<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  require_once("libs/template_engine.php");
  require_once("models/servicios.model.php");
  function run(){

    if(mw_estaLogueado()){
      $datos = array();
      $datos["mostrarErrores"] = false;
      $datos["errores"] = array();
      $datos["txtNombre"]="";
      $datos = array();
      $datos["tblservicios"] = obtenerServicios();

        if (isset($_POST["btnCancelar"])) {
            header("Location:index.php?page=listadoEmpresa");
        }

      renderizar("servicios", $datos);
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();

 ?>
