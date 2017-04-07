<?php
    require_once("libs/dao.php");

    function obtenerTodosMensajes(){
        $sqlstr = "Select * from mensajes;";
        return obtenerRegistros($sqlstr);
    }

    function obtenerMensajesConFiltro($contenido){
        $sqlstr = sprintf("select * from mensajes where msgdsc like '%s%'; "
                        , valstr($contenido));
        return obtenerRegistros($sqlstr);
    }
    function obtenerMensajePorID($mensajeID){
        $sqlstr = sprintf("select * from mensajes where msgid = %d; "
                        , intval($mensajeID));
        return obtenerUnRegistro($sqlstr);
    }

    function obtenerNumeroMensajes(){
        $sqlstr = "select count(*) as NumMensajes from mensajes;";
        return obtenerUnRegistro($sqlstr)["NumMensajes"];
    }

    function guardarMensaje($mensaje){
        $insStr = sprintf("insert into mensajes (msgdsc) values ('%s');",
                        valstr($mensaje)
                    );
        return ejecutarNonQuery($insStr);
    }

    function modificarMensaje($msgid, $msgdsc){
        $updstr  = sprintf("update mensajes set msgdsc='%s' where msgid=%d",
                            valstr($msgdsc),
                            intval($msgid)
                        );
        return ejecutarNonQuery($updstr);
    }

    function eliminarMensaje($msgid){
        $delstr = sprintf("Delete from mensajes where msgid=%d;",
                            intval($msgid)
                        );
        return ejecutarNonQuery($delstr);
    }
 ?>
