<?php
/* Example Controller
     * 2015-10-14
     * Created By OJBA
     * Last Modification 2015-10-14 20:04
     */
      /*En esta seccion se cargan los modelos de datos necesarios para obtener la información*/
      require_once("models/mensajes.model.php");

      function run(){
        /* Procesamiento */
        $mensajes_data = array();
        /*
        usando una funcion del modelo de datos se extrae un arreglo de registros
        */
        $mensajes =obtenerTodosMensajes();
        $mensajes_data["mensajes"] = $mensajes ;
        $mensajes_data["mensajescount"] = count($mensajes);

        /*Se manda a llamar a generar la vista donde
            renedizar("viewName", $Parameters, ["layoutName"]);
            viewName: el nombre de la vista, debe existir en la carpeta
                     /views/ el archivo  viewName.view.tpl
            parameters: arreglo asociativo que se utiliza para rendeziar la vista 
                    es requerido que todo elemento sea asociado a una llave
                    alfanumérica.
            layoutName: nombre del layout alterno a usar, debe existir en la
                        carpeta de vistas, , si se omite este parametro el
                        framework usa layout.view.tpl de forma predeterminada.
         En este ejemplo,
            renderizar("mesnajes", $mensajes_data);
            buscar el archivo /views/mensajes.view.tpl y lo renderiza
            substituyendo los elementos de $mensajes_data.
        */
        renderizar("mensajes", $mensajes_data);
      }

      run();
?>
