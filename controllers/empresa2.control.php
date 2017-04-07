<?php
require_once("libs/template_engine.php");
require_once("models/empresa.model.php");
require_once("models/roles.model.php");//se encuentra la funcion filtrado la cual valida los campos.

function run(){

  if(mw_estaLogueado()){
    $arrDatos["EmpresaNombre"]="";
    $arrDatos["EmpresaRepresentante"] = "";
    $arrDatos["EmpresaComercial"]="";
    $arrDatos["EmpresaRTN"]="";
    $errores="";
    $arrDatos["deleting"]= false;
    $arrDatos["errores"]="";
    $arrDatos["mode"]= $_GET["mode"];


     if(isset($_POST["btnGuardar"])){
       if(empty($_POST["EmpresaNombre"])){
        $errores.= "El nombre empresa es requerido. \\n";
     }

      if(empty($_POST["EmpresaRepresentante"])){
        $errores.= "El nombre representante es requerido. \\n";
     }

     if(empty($_POST["EmpresaComercial"])){
        $errores.= "El nombre comercial es requerido.\\n";
     }

     if(empty($_POST["EmpresaRTN"])){
        $errores.= "El RTN es requerido. \\n";
     }
     $arrDatos["errores"]=$errores;
     if (empty($errores)) {
       if($arrDatos["mode"]=="UPD"){

           actualizarEmpresa($_POST["EmpresaCodigo"],filtrado($_POST["EmpresaNombre"]),filtrado($_POST["EmpresaRepresentante"]),filtrado($_POST["EmpresaComercial"]),filtrado($_POST["EmpresaRTN"]));
           redirectWithMessage("Empresa Guardado Exitosamente","index.php?page=listadoEmpresa");
      }
     }

}

    if(isset($_POST["btnEliminar"])){
      eliminarEmpresa($_POST["EmpresaCodigo"]);
      redirectWithMessage("Tipo de Empresa Eliminado ","index.php?page=listadoEmpresa");
    }

     if(isset($_GET["EmpresaCodigo"])){
       $arrDatos["EmpresaCodigo"]= $_GET["EmpresaCodigo"];
       $tmpRegistro= obtenerPorEmpresa($arrDatos["EmpresaCodigo"]);


       $arrDatos["EmpresaNombre"]=$tmpRegistro["EmpresaNombre"];
       $arrDatos["EmpresaRepresentante"]=$tmpRegistro["EmpresaRepresentante"];
       $arrDatos["EmpresaComercial"]=$tmpRegistro["EmpresaComercial"];
       $arrDatos["EmpresaRTN"]=$tmpRegistro["EmpresaRTN"];

       $arrDatos["enabled"]=false;
     }

       if($arrDatos["mode"]=="INS"){
         $arrDatos["enabled"]= true;
       }

       if($arrDatos["mode"]=="DLT"){
         $arrDatos["deleting"]= true;
       }

       renderizar("empresa2",$arrDatos);
  }else {
    mw_redirectToLogin("page=login2");
  }
   }
   run();
 ?>
