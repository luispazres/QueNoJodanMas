<?php
     //modelo de datos Servicios
     require_once("libs/dao.php");

      function obtenerServicios(){
      $servicio = array();
      $sqlstr = sprintf("SELECT * FROM tblservicios");
      $servicio = obtenerRegistros($sqlstr);
      return $servicio;

  }

  /*Insertar Servicios*/
  function insertarServicios($ServicioNombre){
      $strsql = "INSERT INTO tblservicios
                  (ServicioNombre)
                 VALUES
                  ('%s');";
      $strsql = sprintf($strsql, valstr($ServicioNombre));

      if(ejecutarNonQuery($strsql)){
          return getLastInserId();
      }
    }


  /*Eliminar Servicios*/
  function eliminarServicios($serviciocodigo){
  $delSql = "delete from tblservicios where ServicioCodigo=%d;";
  $result =  ejecutarNonQuery(sprintf($delSql, $serviciocodigo));
  return ($result > 0) && true;
}

  /*Actualizar Servicios*/
  function actualizarServicios($serviciocodigo,$servicionombre){
    $updSql = "update tblservicios set ServicioNombre='%s'  where ServicioCodigo= %d;";
    $result = ejecutarNonQuery(sprintf($updSql,$servicionombre,$serviciocodigo));
    return ($result > 0) && true;
  }

  function obtenerPorCodigo($ServicioCodigo){
    $registro = array();
    $sqlstr = "select * from tblservicios where ServicioCodigo=%d;";
    $registro = obtenerUnRegistro(sprintf($sqlstr,$ServicioCodigo));
    return $registro;
  }

?>
