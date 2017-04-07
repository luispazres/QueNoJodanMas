<?php

    session_start();

    require_once("libs/utilities.php");

    $pageRequest = "login2";

    if(isset($_GET["page"])){
        $pageRequest = $_GET["page"];
    }

    require_once("controllers/verificar.mw.php");
    require_once("controllers/site.mw.php");

    switch($pageRequest){
        case "login2":
                  require_once("controllers/login2.control.php");
                  break;
        case "CerrarSesion":
                  require_once("controllers/CerrarSesion.control.php");
                  break;
        case "mensajes":
                  require_once("controllers/mensajes.control.php");
                  break;
        case "mensajeform":
                  require_once("controllers/mensajesform.control.php");
                  break;
        case "registrate":
                  require_once("controllers/registrate.control.php");
                  break;
        case "empresa":/*REGISTRO DE EMPRESA*/
                  require_once("controllers/empresa.control.php");
                  break;
       case "listadoEmpresa":/*Listado de Las Empresas*/
                  require_once("controllers/listadoEmpresa.control.php");
                  break;
       case "empresa2":
                  require_once("controllers/empresa2.control.php");
                  break;
       case "contrato":/*Registro de contratos*/
                  require_once("controllers/contrato.control.php");
                  break;
       case "servicios":/*Registro de servicios*/
                  require_once("controllers/servicios.control.php");
                  break;
       case "serviciosAgregar":
                   require_once("controllers/serviciosAgregar.control.php");
                   break;
      case "VerContratos":/*muestra los contratos*/
                  require_once("controllers/VerContratos.control.php");
                  break;
      case "contratoEdicion":/*Modifica y Elimina los contratos*/
                  require_once("controllers/contratoEdicion.control.php");
                  break;
      case "usuarios":/*Usuarios*/
                  require_once("controllers/usuarios.control.php");
                  break;
      case "usuarios2":
                  require_once("controllers/usuarios2.control.php");
                  break;
      case "vista":
                 require_once("controllers/vista.control.php");
                 break;
      case "restablecerContrasena":
                 require_once("controllers/restablecerContrasena.control.php");
                 break;
     case "layoutalt":
                 require_once("controllers/layoutalt.control.php");
                 break;
     case "alertaContratos":
                  require_once("controllers/alertaContratos.control.php");
                  break;
    case "dashboard":
                  require_once("controllers/dashboard.control.php");
                  break;
                  case "vistaAyuda":
    require_once("controllers/vistaAyuda.control.php");
                  break;
        default:
            require_once("controllers/error.control.php");

    }
?>
