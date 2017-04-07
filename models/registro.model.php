<?php
    //modelo de datos de usuarios
    require_once("libs/dao.php");

   /*Obtiene los datos del usuario*/
    function obtenerUsuario($userName){
        $usuario = array();
        $sqlstr = sprintf("SELECT usuarioCodigo, usuarioNombre, usuarioApellido, usuarioCorreo, usuarioContrasenia, rolCodigo FROM tblusuarios where usuarioCorreo = '%s';",$userName);
        
        $usuario = obtenerUnRegistro($sqlstr);
        return $usuario;
    }
    
    function verificarExistencia($userName){
        $usuario = 0;
        $sqlstr = sprintf("SELECT COUNT(*) 'Existencia' FROM tblusuarios where usuarioCorreo = '%s';",$userName);

        $usuario = obtenerUnRegistro($sqlstr);
        return $usuario;
    }

    function obtenerUsuarios(){
    $usuarios = array();
    $sqlstr =  sprintf("SELECT tblusuarios.usuarioCodigo,tblusuarios.usuarioNombre,tblusuarios.usuarioApellido,tblusuarios.usuarioCorreo, tblroles.rolNombre 'Cargo' from tblusuarios  inner join tblroles on
    tblusuarios.rolCodigo=tblroles.rolCodigo;");
    $usuarios =  obtenerRegistros($sqlstr);
    return $usuarios;
    }


 /*Registra un usuario*/
  function insertarRegistro($userName,$apellido,$Email, $password,$rol){
      $strsql = "INSERT INTO tblusuarios
                  (usuarionombre, usuarioapellido ,usuariocorreo, usuariocontrasenia,rolCodigo)
                 VALUES
                  ('%s', '%s', '%s','%s','%d');";
      $strsql = sprintf($strsql, valstr($userName),$apellido,$Email,
                                  $password,$rol);

      if(ejecutarNonQuery($strsql)){
          return getLastInserId();
      }

    }

    /*Modifica usuario*/
    function actualizarUsuario($usuarioCodigo,$usuarioanombre,$usuarioApellido, $usuariocorreo,$rol){
      $updSql = "UPDATE tblusuarios set usuarioNombre='%s', usuarioApellido='%s', usuarioCorreo= '%s', rolCodigo= '%d' where usuarioCodigo= %d;";
      $result = ejecutarNonQuery(sprintf($updSql,$usuarioanombre,$usuarioApellido,$usuariocorreo,$rol,$usuarioCodigo ));
      return ($result > 0) && true;
    }


        function borrarUsuario($usuarioCodigo){
        $usuarios = array();
        $sqlstr = sprintf("delete from tblusuarios where usuarioCodigo= '%d'",$usuarioCodigo);

        if(ejecutarNonQuery($sqlstr)){
            return getLastInserId();
        }

        return $contratos;
        }

     //Restablece la contrasena
    function actualizarRegistro($usuarioCodigo, $password){
     $updSql = "update tblusuarios set usuarioContrasenia='%s' where usuarioCodigo='%d';";
     $result = ejecutarNonQuery(sprintf($updSql,$password,$usuarioCodigo));
     return ($result > 0) && true;
   }

    function obtenerCodigo($usuarioCodigo){
      $registro = array();
      $sqlstr = "select * from tblusuarios where usuarioCodigo=%d;";
      $registro = obtenerUnRegistro(sprintf($sqlstr,$usuarioCodigo));
      return $registro;
    }
?>
