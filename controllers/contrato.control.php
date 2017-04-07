<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  require_once("libs/template_engine.php");
  require_once("models/contratos.model.php");
  require_once("models/servicios.model.php");
  require_once("models/subirArchivo.model.php");
  require_once("models/roles.model.php");//funcion filtrado(validaciones)
  function run(){

    if(mw_estaLogueado()){
      $datos = array();
      $datos["mostrarErrores"] = false;
      $datos["errores"] = array();
      $datos["txtNombre"]="";
      $datos["txtVigencia"] = "";
      $datos["txtValor"]="";
      $datos["fechaInicial"]="";
      $datos["fechaVencimiento"]="";
      $datos["documento"]= "";
      $datos["moneda"]= "";
      $datos["estados"]="";

      $servicio = array();
      $estados = array();
      $servicio= obtenerServicios();
      $vigencia=  array();
      $estados = obtenerEstados();
      $vigencia= obtenerVigencias();
      $contratoId="";
      $codigoEmpresa="";
      $codigoEmpresa="";
      $alerta="";

      if (isset($_GET["EmpresaCodigo"])) {
        $codigoEmpresa=$_GET["EmpresaCodigo"];
      }

      if(isset($_POST["btnGuardar"])){
        $datos["txtCodEmpresa"]=$_POST["txtCodEmpresa"];
        $datos["moneda"]=$_POST["txtMoneda"];
        $datos["txtVigencia"]=filtrado($_POST["txtVigencia"]);
        $datos["txtValor"]=filtrado($_POST["txtValor"]);
        $datos["fechaInicial"]=$_POST["fechaInicial"];
        $datos["fechaVencimiento"]=$_POST["fechaVencimiento"];

        if(empty($_POST["txtServicio"])){
            $errores[] = "Tipo de servicio requerido";
            redirectWithMessage("Tipo de servicio requerido");
        }

        if(empty($_POST["txtVigencia"])){
              $errores[] = "vigencia requerida";
              redirectWithMessage("vigencia requerida");
        }

        if(!filter_var($_POST["txtValor"], FILTER_VALIDATE_FLOAT) || empty($_POST["txtValor"])){
            $errores[] = "No se ha indicado el valor adecuado o no a ingresado ninguno";
            redirectWithMessage("No se ha indicado el valor adecuado o no a ingresado ninguno");
        }

        if(empty($errores)) {
          $datos["txtServicio"]=filtrado($_POST["txtServicio"]);
          $datos["txtVigencia"]=filtrado($_POST["txtVigencia"]);
          $datos["txtValor"]=filtrado($_POST["txtValor"]);
          $datos["estados"]=filtrado($_POST["txtEstado"]);
        }

        $contratoId=InsertarContratos( $datos["fechaInicial"],  $datos["fechaVencimiento"],$datos["txtVigencia"],$datos["txtValor"],$datos["txtCodEmpresa"], $datos["moneda"],$datos["estados"]);

        if(!empty($_POST['txtServicio'])) {
        foreach($_POST['txtServicio'] as $check) {

               InsertarServiciosDetalles($contratoId,$check);

            }
        }

        $files = $_FILES['userfile']['name'];
       //creamos una nueva instancia de la clase multiupload
        $upload = new Multiupload();
      //llamamos a la funcion upFiles y le pasamos el array de campos file del formulario
       $isUpload = $upload->upFiles($files,$contratoId);
       if ($isUpload<1) {

         borrarContrato($contratoId);
         $alerta=redirectWithMessage("Error al subir el archivo ","index.php?page=listadoEmpresa");
       }else {
         header("Location:index.php?page=listadoEmpresa");
       }
      }

      if(isset($_POST["btnCancelar"])){
          header("Location:index.php?page=listadoEmpresa");
      }

        renderizar("contrato", array("servicio"=>$servicio,"vigencia"=>$vigencia,"datos"=> $codigoEmpresa,"alerta"=>$alerta,"estados"=>$estados));
    }else {
      mw_redirectToLogin("page=login2");
    }


  }
  run();

 ?>
