<?php
//middleware de verificación
    function mw_estaLogueado(){
        if( isset($_SESSION["userLogged"]) && $_SESSION["userLogged"] == true){
          return true;
        }else{
          $_SESSION["userLogged"] = false;
          $_SESSION["userName"] = "";
          $_SESSION["rol"] = "";
          return false;
        }
    }
    function mw_setEstaLogueado($usuario, $logueado, $rol,$nombre, $apellido){
        if($logueado){
            $_SESSION["userLogged"] = true;
            $_SESSION["userName"] = $usuario;
            $_SESSION["rol"]=$rol;
            $_SESSION["nombre"]=$nombre;
            $_SESSION["apellido"]=$apellido;
        }else{
            $_SESSION["userLogged"] = false;
            $_SESSION["userName"] = "";
            $_SESSION["rol"] = "";
            $_SESSION["nombre"]=$nombre;
            $_SESSION["apellido"]=$apellido;
        }
    }
    function mw_redirectToLogin($to){
        $loginstring = urlencode("?".$to);
        $url = "index.php?page=login2&returnUrl=".$loginstring;
        header("Location:" . $url);
        die();
    }
?>
