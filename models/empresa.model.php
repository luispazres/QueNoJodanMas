<?php
 require_once("libs/dao.php");

    /*Busca las  Empresas*/
  function obtenerEmpresa($empresanombre, $empresarepresentante, $empresacomercial){
  $sqlstr = "";
  if($empresanombre == "" && $empresarepresentante == "" && $empresacomercial == ""){
      $sqlstr = "select distinct e.EmpresaCodigo, e.EmpresaNombre, e.EmpresaRepresentante, e.EmpresaComercial,e.EmpresaRTN, (select count(co.ContratoCodigo) from tblcontratos as co where co.EmpresaCodigo=e.EmpresaCodigo) 'CantidadContratos' from tblempresa as e  ORDER BY EmpresaNombre ASC;";
  }else{
    $whereArray = array();
    if($empresanombre !== ""){
      $whereArray[] = sprintf("empresanombre like '%s' ", $empresanombre.'%');
    }
    if($empresarepresentante !== ""){
      $whereArray[] = sprintf("empresarepresentante like '%s' ", $empresarepresentante.'%');
    }
    if($empresacomercial !== ""){
      $whereArray[] = sprintf("empresacomercial like '%s' ", $empresacomercial.'%');
    }


    $sqlstr = sprintf("select * from tblempresa where %s ;",
                          implode($whereArray," and ")
                      );
  }

  $tblempresa = array();
  $tblempresa = obtenerRegistros($sqlstr);
  return $tblempresa;
}

/*Registro empresa*/
function insertarEmpresa($empresanombre,$empresarepresentante, $empresacomercial,$rtn){
   $strsql = "INSERT INTO tblempresa
               (empresanombre, empresarepresentante, empresacomercial,empresaRTN)
              VALUES
               ('%s', '%s', '%s','%s');";
   $strsql = sprintf($strsql, valstr($empresanombre),$empresarepresentante,
                               $empresacomercial,$rtn);

   if(ejecutarNonQuery($strsql)){
       return getLastInserId();
   }

 }
    /*Modifica la empresa*/
    function actualizarEmpresa($empresacodigo,$empresanombre,$empresarepresentante, $empresacomercial,$empresaRTN){
      $updSql = "update tblempresa set empresanombre='%s', empresarepresentante='%s', empresacomercial= '%s', empresaRTN= '%d' where empresacodigo= %d;";
      $result = ejecutarNonQuery(sprintf($updSql,$empresanombre,$empresarepresentante, $empresacomercial,$empresaRTN ,$empresacodigo));
      return ($result > 0) && true;
    }

    /*elimina las empresas*/
    function eliminarEmpresa($empresacodigo){
    $delSql = "delete from tblempresa where empresacodigo=%d;";
    $result =  ejecutarNonQuery(sprintf($delSql, $empresacodigo));
    return ($result > 0) && true;
  }


  function obtenerPorEmpresa($empresacodigo){
    $registro = array();
    $sqlstr = "select * from tblempresa where empresacodigo=%d;";
    $registro = obtenerUnRegistro(sprintf($sqlstr,$empresacodigo));
    return $registro;
  }

 ?>
