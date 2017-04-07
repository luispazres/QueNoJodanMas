<?php
     //modelo de datos Contratos y documentos
     require_once("libs/dao.php");

     /*Insertar Contratos*/
     function insertarContratos($fechsinicio,$fechafinal,$vigencia,$valor ,$codigoEmpresa,$moneda,$estado){
         $strsql = "INSERT INTO tblcontratos
                     (ContratoFechaInicio, ContratoFechaFinal ,VigenciaCodigo,ContratoValor ,EmpresaCodigo, MonedaCodigo, EstadoCodigo)
                    VALUES
                     ('%s', '%s', %d ,'%f', %d, %d, %d);";
         $strsql = sprintf($strsql,$fechsinicio,$fechafinal,
                                     $vigencia,$valor,$codigoEmpresa,$moneda,$estado);

         if(ejecutarNonQuery($strsql)){
             return getLastInserId();
         }
       }

       /*Vista de todos los contratos*/
          function obtenerContratosAlerta(){
          $contratos = array();
          $sqlstr = sprintf("SELECT  c.ContratoCodigo,e.EmpresaNombre 'NombreEmpresa',c.ContratoFechaInicio,c.ContratoFechaFinal
          from tblempresa as e, tblcontratos as c   where e.EmpresaCodigo= c.EmpresaCodigo ;");
          $contratos = obtenerRegistros($sqlstr);
          return $contratos;
          }

     /*Obtener vigencias de contratos*/
     function obtenerVigencias(){
     $servicio = array();
     $sqlstr = sprintf("SELECT * FROM tblvigencia");
     $servicio = obtenerRegistros($sqlstr);
     return $servicio;

    }

    function obtenerServiciosPorEmpresa($EmpresaCodigo){
    $servicio = array();
    $sqlstr = sprintf("SELECT sd.ContratoCodigo, s.ServicioNombre FROM tblserviciosdetalles sd, tblservicios as s, tblcontratos as c, tblempresa as e where sd.ServicioCodigo=s.ServicioCodigo and sd.ContratoCodigo=c.ContratoCodigo and c.EmpresaCodigo=e.EmpresaCodigo and e.EmpresaCodigo=%d",$EmpresaCodigo);
    $servicio = obtenerRegistros($sqlstr);
    return $servicio;

   }

   function obtenerServiciosPorContratos($ContratoCodigo){
   $sqlstr = sprintf("SELECT sd.ContratoCodigo, s.ServicioNombre FROM tblserviciosdetalles sd, tblservicios as s, tblcontratos as c where sd.ServicioCodigo=s.ServicioCodigo and sd.ContratoCodigo=c.ContratoCodigo and sd.ContratoCodigo=%d",$ContratoCodigo);
   $servicio["servicios"] = obtenerRegistros($sqlstr);
   return $servicio["servicios"];

  }

    function obtenerEstados(){
    $servicio = array();
    $sqlstr = sprintf("SELECT * FROM tblestado");
    $servicio = obtenerRegistros($sqlstr);
    return $servicio;
  }

    function obtenerTodosLosContratos(){
    $servicio = array();
    $sqlstr = sprintf("SELECT c.ContratoCodigo, c.ContratoFechaInicio, c.ContratoFechaFinal, c.VigenciaCodigo, c.EmpresaCodigo, c.ContratoValor, e.EmpresaNombre FROM tblcontratos as c, tblempresa as e  where c.EmpresaCodigo=e.EmpresaCodigo ");
    $servicio = obtenerRegistros($sqlstr);
    return $servicio;

   }

    /*Obtener documentos*/
    function obtenerDocumento($DocumentoCodigo){
    $documento = array();
    $sqlstr = "SELECT * FROM tbldocumento where DocumentoCodigo=%d;";
    $documento = obtenerRegistro(sprintf($sqlstr,$DocumentoCodigo));
    return $documento;
   }

   function obtenerUnContrato($ContratoCodigo){
   $documento = array();
   $sqlstr = "SELECT * FROM tblcontratos where ContratoCodigo='%d';";
   $documento = obtenerUnRegistro(sprintf($sqlstr,$ContratoCodigo));
   return $documento;
  }

    function obtenerServiciosDetalles($ContratoCodigo){
    $documento = array();
    $sqlstr = "SELECT ServicioCodigo, ServicioNombre FROM tblserviciosdetalles where ContratoCodigo='%d';";
    $documento = obtenerUnRegistro(sprintf($sqlstr,$ContratoCodigo));
    return $documento;
    }

    function obtenerServiciosDetallesSite($ContratoCodigo){
    $documento = array();
    $sqlstr = "SELECT sd.ServicioCodigo, s.ServicioNombre FROM tblserviciosdetalles as sd, tblservicios as s where sd.ServicioCodigo=s.ServicioCodigo and ContratoCodigo = %d";
    $documento = obtenerUnRegistro(sprintf($sqlstr,$ContratoCodigo));
    return $documento;
    }

    /*Muestra contratos por emmpresa*/
    function obtenerContratos($EmpresaCodigo){

    $sqlstr = "SELECT e.EmpresaCodigo, c.ContratoCodigo,c.ContratoFechaInicio,c.ContratoFechaFinal,c.ContratoValor, v.VigenciaMeses,d.DocumentoNombreArchivo 'NombredelContrato', d.DocumentoDireccion, m.MonedaNombre, c.EstadoCodigo, est.EstadoNombre
    from tblempresa as e,tblmoneda as m, tblcontratos as c ,tbldocumento as d, tblvigencia as v, tblestado as est
    where c.VigenciaCodigo=v.VigenciaCodigo and e.EmpresaCodigo= c.EmpresaCodigo and c.ContratoCodigo=d.ContratoCodigo
	  and c.MonedaCodigo=m.MonedaCodigo and c.EstadoCodigo=est.EstadoCodigo
    and e.EmpresaCodigo=%d;";

    $contratos["contratos"] = obtenerRegistros(sprintf($sqlstr,$EmpresaCodigo));

    return $contratos["contratos"];
    }

    function borrarContrato($ContratoCodigo){
    $contratos = array();
    $sqlstr = sprintf("delete from tblcontratos where ContratoCodigo= '%d'",$ContratoCodigo);

    if(ejecutarNonQuery($sqlstr)){
        return getLastInserId();
    }

    return $contratos;
    }

    function DescargarArchivo($fichero){

      if (file_exists($fichero)) {
      set_time_limit(0);
             header('Connection: Keep-Alive');
             header('Content-Description: File Transfer');
             header('Content-Type: application/octet-stream');
             header('Content-Disposition: attachment; filename="'.basename($fichero).'"');
             header('Content-Transfer-Encoding: binary');
             header('Expires: 0');
             header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
             header('Pragma: public');
             header('Content-Length: ' . filesize($fichero));
             ob_clean();
             flush();
             readfile($fichero);
      }
    }

     /*Documentos*/
     function InsertarArchivos($tamanio,$nombreArchivo,$Tipo,$direccion){
      $strsql = "INSERT INTO tbldocumento (DocumentoNombreArchivo, DocumentoTamanio, DocumentoTipo,DocumentoDireccion) values('%s','%d','%s','%s');";
      $strsql = sprintf($strsql,$tamanio,$nombreArchivo,$Tipo,$direccion);

      if(ejecutarNonQuery($strsql)){
          return getLastInserId();
      }
    }

  function InsertarServiciosDetalles($contratoCodigo, $servicioCodigo){
     $strsql = "INSERT INTO tblserviciosdetalles (ContratoCodigo, ServicioCodigo) values(%d,%d);";
     $strsql = sprintf($strsql,$contratoCodigo,$servicioCodigo);

     if(ejecutarNonQuery($strsql)){
         return getLastInserId();
     }
   }

   function BorrarServiciosDetalles($servicioCodigo){
      $strsql = "DELETE FROM tblserviciosdetalles where ContratoCodigo ='%d';";
      $strsql = sprintf($strsql,$servicioCodigo);

      if(ejecutarNonQuery($strsql)){
          return getLastInserId();
      }
    }



     /*Actualizar contratos variables tipo datetime */
     function ActualizarContrato($contratoCodigo,$contratoVigencia,$contratoFechaInicio,$contratoFechaFinal,$ContratoValor,$moneda,$estado){
      $updSql = "UPDATE tblcontratos set contratoFechaInicio = '%s', contratoFechaFinal = '%s', VigenciaCodigo='%s', ContratoValor='%f', MonedaCodigo=%d,EstadoCodigo=%d where contratoCodigo ='%d';";
      $result = ejecutarNonQuery(sprintf($updSql,$contratoFechaInicio,$contratoFechaFinal,$contratoVigencia,$ContratoValor,$moneda,$estado,$contratoCodigo));
      return $result ;
     }

      /*Eliminar contrato*/
      function EliminarDocumento($DocumentoCodigo)
      {
        $delSql ="delete from tbldocumento where DocumentoCodigo=%d;";
        $result= ejecutarNonQuery(sprintf($delSql,$DocumentoCodigo));
        return ($result>0) && true;
      }
