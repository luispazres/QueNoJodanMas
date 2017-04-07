<?php
require_once("libs/template_engine.php");
require_once("models/contratos.model.php");
require_once("models/empresa.model.php");
require_once("models/servicios.model.php");
require_once("models/subirArchivo.model.php");
require_once("models/roles.model.php");

function run(){
  $contratosDatos["mode"]= $_GET["mode"];

  if(mw_estaLogueado()){
    if(isset($_GET["ContratoCodigo"])){
    $Datos = array();
    $estados = array();
    $estados = obtenerEstados();
    $servicio = array();
    $vigencias=  array( );
    $Datos["contratosDatos"]=obtenerUnContrato($_GET["ContratoCodigo"]);
    $vigencias=obtenerVigencias();
    $servicio= obtenerServicios();//obtenemos el array de servicios
    $ContratoCodigo= $_GET["ContratoCodigo"];
    $EmpresaCodigo=$_GET["EmpresaCodigo"];
    $serviciosDetalles="";
    }

    if(isset($_POST["btnGuardar"])){
      //  $servicon=array("servicio"=>$_POST["ContratoFechaFinal"]);
      if(empty($_POST["txtServicio"])){
          $errores[] = "Tipo de servicio requerido";
          redirectWithMessage("Tipo de servicio requerido");
      }

      if(empty($_POST["txtVigencia"])){
            $errores[] = "vigencia requerida";
            redirectWithMessage("vigencia requerida");
      }

      if(!filter_var($_POST["ContratoValor"], FILTER_VALIDATE_FLOAT) || empty($_POST["ContratoValor"])){
          $errores[] = "No se ha indicado el valor adecuado o no a ingresado ninguno";
          redirectWithMessage("No se ha indicado el valor adecuado o no a ingresado ninguno");
      }

      if(empty($errores)) {
        $datos["txtServicio"]=filtrado($_POST["txtServicio"]);
        $datos["txtVigencia"]=filtrado($_POST["txtVigencia"]);
        $datos["txtValor"]=filtrado($_POST["ContratoValor"]);
      }

      BorrarServiciosDetalles($_POST["txtCodContrato"]);

      if(!empty($_POST['txtServicio'])) {
      foreach($_POST['txtServicio'] as $check) {
             InsertarServiciosDetalles($_POST["txtCodContrato"],$check);
          }
      }

        $EmpresaCodigo="";
        $EmpresaCodigo=$_POST["txtEmpresaCodigo"];
        $location="";
        ActualizarContrato( $_POST["txtCodContrato"],filtrado($_POST["txtVigencia"]) ,$_POST["ContratoFechaInicio"],$_POST["ContratoFechaFinal"],filtrado($_POST["ContratoValor"]),filtrado($_POST["txtMoneda"]),filtrado($_POST["txtEstado"]));
        $location="Location:index.php?page=VerContratos&mode=Ver&EmpresaCodigo=".$EmpresaCodigo;
        header($location);
    }
     renderizar("contratoEdicion",array("datos" => $Datos, "servicio"=>$servicio,"vigencias"=>$vigencias,"contratoCodigo"=>$ContratoCodigo,"empresaCodigo"=>$EmpresaCodigo,"estados"=>$estados) );
  }else {
    mw_redirectToLogin("page=login2");
  }
}
  run();
 ?>
