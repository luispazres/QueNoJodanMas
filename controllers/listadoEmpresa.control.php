 <?php
      require_once("libs/template_engine.php");
      require_once("models/empresa.model.php");
      require_once("models/pagination.model.php");

      function run(){
        /* Procesamiento */
        $dataPlantilla = array();
        $dataPlantilla["empresanombre"] = "";
        $dataPlantilla["empresarepresentante"] = "";
        $dataPlantilla["empresacomercial"] ="";

          $dataPlantilla["tblempresa"] = array();
          $dataPlantilla["tblempresa"] = obtenerEmpresa(
                                              $dataPlantilla["empresanombre"] ,
                                              $dataPlantilla["empresarepresentante"] ,
                                              $dataPlantilla["empresacomercial"]
                                            );

        renderizar("listadoEmpresa", $dataPlantilla);
      }
      run();
     ?>
