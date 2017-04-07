<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  require_once("libs/template_engine.php");
  require_once("models/registro.model.php");
  require_once("models/roles.model.php");
  function run(){

    if(mw_estaLogueado()){
      $datos = array();
      $datos["mostrarErrores"] = false;
      $datos["errores"] = array();
      $datos["txtEmail"]="";
      $datos["txtUserName"] = "";
      $datos["txtApellido"] = "";
      $datos["password"]="";
      $datos["txtPasswordCnf"]="";
      $roles = array();
      $roles= obtenerRoles();
      $datos["txtCargo"]="";
      $alerta="";
      $checkUser=0;


      if(isset($_POST["btnRegistrar"])){
        $datos["txtEmail"] = filtrado($_POST["txtEmail"]);
        $datos["txtUserName"] = filtrado($_POST["txtUserName"]);
        $datos["txtApellido"] = filtrado($_POST["txtApellido"]);
        $password = filtrado($_POST["password"]);
        $passwordCnf = $_POST["txtPasswordCnf"];
        $datos["txtCargo"]= $_POST["txtCargo"];
        
          
           if(empty($_POST["txtUserName"])){
               $errores[] = "El nombre es requerido";
               redirectWithMessage("El nombre es requerido");
           }
           
           if(empty($_POST["txtApellido"])){
               $errores[] = "El apellido es requerido";
               redirectWithMessage("El apellido es requerido");
           }
           
           if(empty($_POST["password"]) || strlen($_POST["password"]) < 5){
               $errores[] = "La contraseña es requerida y ha de ser mayor a 5 caracteres";
           }
           
           if(!filter_var($_POST["txtEmail"], FILTER_VALIDATE_EMAIL) || empty($_POST["txtEmail"])){
               $errores[] = "No se ha indicado email o el formato no es correcto";
               redirectWithMessage("No se ha indicado email o el formato no es correcto");
           }
           
           if(empty($errores)) {
            $datos["txtUserName"]= filtrado($_POST["txtUserName"]);
            $password = filtrado($_POST["password"]);
           }
   
        


        if($password  ==   $passwordCnf){
         $checkUser = verificarExistencia($datos["txtEmail"]);/*verifica que no exista el usuario*/

          if($checkUser["Existencia"]==1){
            $alerta="alert('El correo electronico ya se esta utilizando.')";
          }
         else {
            $password=md5($password);
            $datos["rol"][]=array("nombre"=>"Administrador",
                                 "seleccionado"=>"");
            $datos["rol"][]=array("nombre"=>"Operador",
                                  "seleccionado"=>"");
            $datos["rol"][]=array("nombre"=>"Recepcion",
                                 "seleccionado"=>"");


            $datos["rol"] = addSelectedCmbArray(
            $datos["rol"],
            "nombre",
            $datos["txtCargo"],
            "seleccionado"
        );

            insertarRegistro(   $_POST["txtUserName"],
                                $_POST["txtApellido"],
                                $_POST["txtEmail"],
                                $password,
                                $_POST["txtCargo"]
                                );
            header("Location:index.php?page=usuarios");
          }
        }else{
          $datos["mostrarErrores"] = true;
          $datos["errores"][]=array("errmsg"=>"Contraseñas no coinciden");
          redirectWithMessage("Error,Contraseñas no coinciden");
        }
      }
      
      if(isset($_POST["btnCancelar"])){
          header("Location:index.php?page=usuarios");
      }

      renderizar("registrate",array("rol"=>$roles,"alerta"=>$alerta));
    }else {
      mw_redirectToLogin("page=login2");
    }
  }
  run();
?>

