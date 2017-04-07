<?php
  require_once("libs/template_engine.php");
  require_once("models/contratos.model.php");

  function run(){

    if(mw_estaLogueado()){
      $dataPlantilla2 = array();
      $errores="";
      $servicios = array( );
      $hoy=date('Y-m-d');
      $hoyObjeto= new DateTime(date('Y-m-d H:i:s'));
      $dataPlantilla["tblcontratos"] = obtenerContratosAlerta();
      $td="";
      $serviciosConcatenar="";

      $contratos=obtenerTodosLosContratos();

      foreach ($contratos as $key ) {
        $serviciosTemp=obtenerServiciosPorContratos($key["ContratoCodigo"]);
        foreach ($serviciosTemp as $key2) {
          array_push($servicios, array('ServicioNombre' =>  $key2["ServicioNombre"], 'ContratoCodigo'=>$key2["ContratoCodigo"]) );
        }
      }

      foreach ($contratos as $key ) {
        $serviciosConcatenar="";
        foreach ($servicios as $key2 ) {
          if ($key["ContratoCodigo"]==$key2["ContratoCodigo"]) {
            $serviciosConcatenar.=$key2["ServicioNombre"]."</br>";
          }
        }
        array_push($dataPlantilla2,  array("ContratoCodigo"=>$key["ContratoCodigo"], "ContratoFechaInicio"=>$key["ContratoFechaInicio"], "ContratoFechaFinal"=>$key["ContratoFechaFinal"],
        "EmpresaNombre"=>$key["EmpresaNombre"],"ServicioNombre"=>$serviciosConcatenar));
      }

      print_r($dataPlantilla2);

      foreach ($dataPlantilla2 as $key) {

      $convertedDate=strtotime($key["ContratoFechaFinal"]);
      $vencimientoObjeto = new DateTime(date($key["ContratoFechaFinal"]));
      $dia = date('d',$convertedDate);
      $mes = date('m',$convertedDate);
      $anio= date('Y',$convertedDate);

      $interval = $vencimientoObjeto->diff($hoyObjeto);

      if ($key["ContratoFechaFinal"]<=$hoy) {
        $td.="<tr class='danger'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }

      if ($interval->days==13) {
        $td.="<tr class='warning'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }

      if ($interval->days==28) {

        $td.="<tr class='success'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }

      if ($interval->days==5) {

        $td.="<tr class='info'>
          <td>
            ".$key["ContratoCodigo"]."
          </td>
          <td>
            ".$key["ContratoFechaInicio"]."
          </td>
          <td>
            ".$key["ContratoFechaFinal"]."
          </td>
          <td>
            ".$key["EmpresaNombre"]."
          </td>
          <td>
            ".$key["ServicioNombre"]."
          </td>
        </tr>";
      }
    }
      renderizar("alertaContratos", array('td' => $td ) );
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();
 ?>
