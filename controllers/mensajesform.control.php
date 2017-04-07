<?php
/* Example Controller
     * 2015-10-14
     * Created By OJBA
     * Last Modification 2015-10-14 20:04
     */

      //Cargando Plantillero
      require_once("libs/template_engine.php");
      require_once("models/mensajes.model.php");
      function run(){
        /* require_once("models/entidad.model.php ") */


        /* Procesamiento */
        $mensajeData = array(
            "msgid"=>"",
            "formMode" => "INS",
            "msgdsc"=>"",
            "msgdscdisable" =>true,
            "errors" => array()
        );

        if(isset($_POST["formMode"])){
            //Si es post
            manejarElPost($_POST, $mensajeData);
        }else{
            if(isset($_GET["formmode"])){
                // Si es get
                manejarElGet($_GET, $mensajeData);
            }

        }
        renderizar("mensajeform", $mensajeData);
      }

      function manejarElGet($formData, &$mensajeData){
            $mensajeData["formMode"] = $formData["formmode"];
            switch($mensajeData["formMode"]){
                case "INS":
                    $mensajeData["msgdscdisable"] = false;
                    break;
                case "UPD":
                    $mensajeData["msgdscdisable"] = false;
                case "DEL":
                case "SEL":
                    $Mensaje = obtenerMensajePorID($formData["msgid"]);
                    if($Mensaje){
                        $mensajeData["msgid"] = $Mensaje["msgid"];
                        $mensajeData["msgdsc"] = $Mensaje["msgdsc"];
                    }
                    break;
            }

      }

      function manejarElPost($formData, &$mensajeData){
          $mensajeData["formMode"] = $formData["formMode"];
          switch($mensajeData["formMode"]){
              case "INS":
                  //validacion a nivel de server
                  if(guardarMensaje($formData["msgdsc"]))
                  {
                      redirectWithHtmlMessage("Mensaje Guardado Exitosamente",
                                         "index.php?page=mensajes");
                  }else{
                      $mensajeData["msgdscdisable"] = false;
                      $mensajeData["msgid"] = $formData["msgid"];
                      $mensajeData["msgdsc"] = $formData["msgdsc"];
                      $mensajeData["errors"][] = array("error"=>"No se Insertó el registro de Mensaje");
                  }
                  break;
              case "UPD":
                  if(modificarMensaje($formData["msgid"], $formData["msgdsc"])){
                        redirectWithHtmlMessage("Mensaje Actualizado Exitosamente",
                                           "index.php?page=mensajes");
                  }else{
                      $mensajeData["msgdscdisable"] = false;
                      $mensajeData["msgid"] = $formData["msgid"];
                      $mensajeData["msgdsc"] = $formData["msgdsc"];
                      $mensajeData["errors"][] = array("error"=>"No se Actualizó el registro de Mensaje");
                  }
                  break;
              case "DEL":
                    if(eliminarMensaje($formData["msgid"])){
                        redirectWithHtmlMessage("Mensaje Eliminado Exitosamente",
                                           "index.php?page=mensajes");
                    }else{
                        $mensajeData["msgid"] = $formData["msgid"];
                        $mensajeData["msgdsc"] = $formData["msgdsc"];
                        $mensajeData["errors"][] = array("error"=>"No se Eliminó el registro de Mensaje");
                    }
                  break;
          }
      }
      run();
?>
