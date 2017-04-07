<?php
  require_once("libs/template_engine.php");
  require_once("models/contratos.model.php");
  require_once("models/subirArchivo.model.php");

  function run(){

    if(mw_estaLogueado()){
      $dataPlantilla = array( );
      $contratos =  array( );;
      $serviciosTemp="";
     $empresaCodigo=$_GET["EmpresaCodigo"];

      $accion=$_GET["mode"];

      switch ($accion) {
        case 'DLT':
          $codigoContrato=$_GET["ContratoCodigo"];
          borrarContrato($codigoContrato);
          //redirectWithMessage("Contrato Eliminado ");
          break;
         case 'Ver':

           break;
        default:
          # code...
          break;
      }
      //validar

   if(isset($_GET["DocumentoDireccion"])){
     DescargarArchivo($_GET["DocumentoDireccion"]);
   }

      $contratos["contratos"] = obtenerContratos($empresaCodigo);
      $servicios["servicios"] = obtenerServiciosPorEmpresa($empresaCodigo);

      foreach ($contratos["contratos"] as $key) {
        $serviciosTemp="";
        foreach ($servicios["servicios"] as $key2) {
          if ($key["ContratoCodigo"]==$key2["ContratoCodigo"]) {
            $serviciosTemp.=$key2["ServicioNombre"]."</br>";
          }
        }

        array_push($dataPlantilla, array('ContratoCodigo'=>$key["ContratoCodigo"],'ContratoFechaInicio'=>$key["ContratoFechaInicio"],'ContratoFechaFinal'=>$key["ContratoFechaFinal"],'ContratoValor'=> $key["ContratoValor"],'VigenciaMeses'=>$key["VigenciaMeses"],'MonedaNombre'=>$key["MonedaNombre"],'NombredelContrato'=>$key["DocumentoDireccion"],
        'Servicios'=>$serviciosTemp,'EstadoNombre'=>$key["EstadoNombre"], 'EmpresaCodigo'=> $key["EmpresaCodigo"]));
      }

      print_r($servicios["servicios"]);
      renderizar("VerContratos", array('tblcontratos' => $dataPlantilla ));
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();
 ?>
