<?php

  require_once("libs/template_engine.php");
  require_once("models/registro.model.php");
  require_once("models/roles.model.php");

  function run(){
    $datos= array();
    $datos["mostrarErrores"] = false;
    $datos["errores"] = array();
    $datos["password"]="";
    $datos["txtPasswordCnf"]="";
    $codUsuario=$_GET["usuarioCodigo"];

    if(isset($_POST["btnGuardar"])){
      $password = filtrado($_POST["password"]);
      $passwordCnf = filtrado($_POST["txtPasswordCnf"]);
      $usuarioCodigo=$_POST["txtUsuarioCodigo"];
      
      if(empty($_POST["password"]) || strlen($_POST["password"]) < 5){
          $errores[] = "La contraseña es requerida y ha de ser mayor a 5 caracteres";
      }

      if(empty($_POST["txtPasswordCnf"]) || strlen($_POST["txtPasswordCnf"]) < 5){
          $errores[] = "La contraseña es requerida y ha de ser mayor a 5 caracteres";
      }

      if(empty($errores)) {
       $passwordCnf= filtrado($_POST["txtPasswordCnf"]);
       $password = filtrado($_POST["password"]);
      }

      if($password == $passwordCnf){
        $password=md5($password);

        actualizarRegistro($usuarioCodigo,$password);

        header("Location:index.php?page=usuarios");
        //}
      }else{
        $datos["mostrarErrores"] = true;
        $datos["errores"][]=array("errmsg"=>"Contraseñas no coinciden");
      }
    }
  renderizar("restablecerContrasena",array("usuarioCodigo"=>$codUsuario));
    }
  run();
?>
