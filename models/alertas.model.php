<?php

       require_once("libs/dao.php");

       function insertarAlerta($fecha){
           $strsql = "INSERT INTO tblalertas
                       (AlertaFecha)
                      VALUES
                       ('%s');";
           $strsql = sprintf($strsql,$fecha);

           if(ejecutarNonQuery($strsql)){
               return getLastInserId();
           }
         }

         function obtenerAlerta($fecha){
         $documento = array();
         $sqlstr = "SELECT * FROM tblalertas where AlertaFecha='%s';";
         $documento = obtenerUnRegistro(sprintf($sqlstr,$fecha));
         if ($documento) {
           return true;
         }else {
           return false;
          }
         }
 ?>
