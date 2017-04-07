<?php
function obtenerUsuario($userName){
    $usuario = array();
    $sqlstr = sprintf("SELECT * FROM tblusuarios where usuarioCorreo = '%s';",$userName);

    $usuario = obtenerUnRegistro($sqlstr);
    return $usuario;
}

function obtenerPassword($userName, $password){
    $usuario = array();
    $sqlstr = sprintf("SELECT * FROM tblusuarios where usuarioCorreo = '%s' and usuarioContrasenia='%s';",$userName, $password);

    $usuario = obtenerUnRegistro($sqlstr);
    return $usuario;
}

 ?>
