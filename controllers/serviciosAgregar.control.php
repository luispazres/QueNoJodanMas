<?php
require_once("libs/template_engine.php");
require_once("models/servicios.model.php");

function run(){

  if(mw_estaLogueado()){
    $arrDatos = array();
    $arrDatos["ServicioNombre"]="";

    $arrDatos["deleting"]= false;
    $arrDatos["mode"]= $_GET["mode"];

    if(isset($_POST["btnGuardar"])){
       if($arrDatos["mode"]=="INS"){
      insertarServicios($_POST["ServicioNombre"]);
      header('Location: index.php?page=servicios');
    }
  }


    if(isset($_POST["btnEliminar"])){
      eliminarServicios($_POST["ServicioCodigo"]);
      header('Location: index.php?page=servicios');

    }

     if(isset($_GET["ServicioCodigo"])){
       $arrDatos["ServicioCodigo"]= $_GET["ServicioCodigo"];
       $tmpRegistro= obtenerPorCodigo($arrDatos["ServicioCodigo"]);


       $arrDatos["ServicioNombre"]=$tmpRegistro["ServicioNombre"];

       $arrDatos["enabled"]=false;
     }

       if($arrDatos["mode"]=="INS"){
         $arrDatos["enabled"]= true;
       }

       if($arrDatos["mode"]=="DLT"){
         $arrDatos["deleting"]= true;
       }

       renderizar("serviciosAgregar",$arrDatos);
  }else {
    mw_redirectToLogin("page=login2");
  }
   }
   run();
 ?>

