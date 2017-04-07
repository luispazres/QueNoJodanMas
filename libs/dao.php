<?php
   //data access object
   require_once("libs/parameters.php");

   // ------------------------
   $conexion = new mysqli($server, $user, $pswd ,
                          $database, $port);

   if($conexion->connect_errno){
        //die();
        die($conexion->connect_error);
   }

   function obtenerRegistros($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        $resultArray = array();
        foreach($result as $registro){
            $resultArray[] = $registro;
        }
        return $resultArray;
   }

        /*Bibliotecas agregadas*/
       function get_num_rows() {
       return mysqli_num_rows($this->q_id);
       }

     function get_row_affected(){
     return mysqli_affected_rows($this->db_connect_id);
     }

     function get_insert_id() {
     return mysqli_insert_id($this->db_connect_id);
     }

     function free_result($q_id) {
       if($q_id == ""){
       $q_id = $this->q_id;
      }
      mysqli_free_result($q_id);
      }

      function fetch_row($q_id = "") {
       	if ($q_id == "") {
       		$q_id = $this->q_id;
      	 	}
           $result = mysqli_fetch_array($q_id);
           return $result;
       }



   function obtenerUnRegistro($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        $resultArray = array();

        $resultArray = $result->fetch_assoc();

        return $resultArray;
   }


   function ejecutarNonQuery($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        return $conexion->affected_rows;
   }

   function ejecutarNonQueryConErrores($sqlstr, &$conexion = null){
        if(!$conexion) global $conexion;
        $result = $conexion->query($sqlstr);
        return $conexion->error;
   }

   function valstr($str, &$conexion = null){
      if(!$conexion) global $conexion;
      return $conexion->escape_string($str);
   }

   function getLastInserId(&$conexion = null){
     if(!$conexion) global $conexion;
     return $conexion->insert_id;
   }
?>
