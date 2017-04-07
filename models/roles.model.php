<?php
    //modelo de datos de usuarios
    require_once("libs/dao.php");

   /*Obtiene los datos del usuario*/
   function obtenerRoles(){
       $roles= array();
       $sqlstr = "Select * from tblroles;";
       $roles = obtenerRegistros($sqlstr);
       return $roles;
     }
     
    function filtrado($datos){
    $datos = trim($datos); // Elimina espacios antes y después de los datos
    $datos = stripslashes($datos); // Elimina backslashes \
    $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
    return $datos;
    }


    ?>
