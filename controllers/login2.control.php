<?php
  require_once("libs/template_engine.php");
  require_once("libs/dao.php");
  require_once("models/login.model.php");
  require_once("models/roles.model.php");
  function run(){

    $userName = "";
    $returnUrl = "";
    $errores = array();
    $rolCod["txtCargo"]="";

    if(isset($_POST["btnLogin"])){
        $userName = filtrado($_POST["txtUser"]);
        $pswd = filtrado($_POST["txtPswd"]);
        $usuario = obtenerUsuario($userName);

        // El email es obligatorio y ha de tener formato adecuado
       if(!filter_var($_POST["txtUser"], FILTER_VALIDATE_EMAIL) || empty($_POST["txtUser"])){
        $errores[] = "No se ha indicado email o el formato no es correcto";
        redirectWithMessage("No se ha indicado email o el formato no es correcto");
       }
       
        if(empty($_POST["txtPswd"]) || strlen($_POST["txtPswd"]) < 5){
        $errores[] = "La contraseña es requerida y ha de ser mayor a 5 caracteres";
        redirectWithMessage("La contraseña es requerida y ha de ser mayor a 5 caracteres");
        }
       
       if(empty($errores)) {
        $userName = filtrado($_POST["txtUser"]);
        $pswd = filtrado($_POST["txtPswd"]);
       
      }
        
        if($usuario){

          $pswd=md5($pswd);
          if(obtenerPassword($userName,$pswd)){

            mw_setEstaLogueado($userName, true, $usuario["rolCodigo"], $usuario["usuarioNombre"], $usuario["usuarioApellido"]);
            header("Location:index.php?page=listadoEmpresa");
            die();
           }else{
            $errores[] = array("errmsg"=>"Credenciales Incorrectas");
            redirectWithMessage("Error, Acceso Incorrecto");
          }
        }else{
                 $errores[] = array("errmsg"=>"Credenciales Incorrectas");
                 redirectWithMessage("Error, Acceso Incorrecto.");
               }
      }

      if(isset($_GET["returnUrl"])){
           $returnUrl = urldecode($_GET["returnUrl"]);
      }

           $datos = array("txtUser" => $userName,
                          "returnUrl" => $returnUrl,
                          "mostrarErrores" => (count($errores)>0),
                          "errores" => $errores);

           renderizar("login2", $datos);

         }
         run();
       ?>

