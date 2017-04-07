<?php
     require_once("libs/template_engine.php");
     require_once("models/registro.model.php");
     require_once("models/pagination.model.php");

     function run(){
       /* Procesamiento */

       if(mw_estaLogueado()){
         $data = array();
         $data["usuarioNombre"] = "";
         $data["usuarioApellido"] = "";
         $data["usuarioCorreo"] ="";

         $data["tblusuarios"] = array();
         $data["tblusuarios"] = obtenerUsuarios(
                                 $data["usuarioNombre"],
                                 $data["usuarioApellido"],
                                 $data["usuarioCorreo"]
                                );

         renderizar("usuarios", $data);
       }else {
         mw_redirectToLogin("page=login2");
       }
     }
     run();
    ?>