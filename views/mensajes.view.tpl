<h1>Mensajes Registrados</h1>
<div style="text-align:right">
    <a href="index.php?page=mensajeform&formmode=INS">
        Insertar Nuevo
    </a>
    &nbsp; | &nbsp;
    <a href="index.php?page=mensajes">Refrescar</a>
</div>
<!--
todo lo que se encuentre entre { { llaveEnArreglo  } } será substituido
por el valor del arreglo que fue enviado en el método renderizar
-->
<b>Mostrando {{mensajescount}} Registros</b>
<table style="width:920px;margin:0px auto;">
    <tr>
        <th class="center">
            Código
        </th>
        <th>
            Mensaje
        </th>
        <th class="center">
            Acciones
        </th>
    </tr>
<!--
    El Plantillero tiene unas comandos basicos para interactuar

    { {foreach llave} } .... { {endfor llave} }
    es importante que el siclo use la llave del arreglo de arreglos asociativos
    que se utilizará para iterar por los datos, las llaver internas se utilizarán
    com contexto raíz.

    { {if llave} } .... { {endif llave} }
    Si el valor de la llave es verdadera (valor debe ser booleano) se muestra
    se procede a evaluar el bloque interno, si es falsa todo el bloque
    interno se ignora.
-->
{{foreach mensajes}}
    <tr>
        <td class="center">
            {{msgid}}
        </td>
        <td>
            {{msgdsc}}
        </td>
        <td class="center">
            <a href="index.php?page=mensajeform&formmode=SEL&msgid={{msgid}}">Ver</a>
            | <a href="index.php?page=mensajeform&formmode=UPD&msgid={{msgid}}">Actualizar</a>
            | <a href="index.php?page=mensajeform&formmode=DEL&msgid={{msgid}}">Borrar</a>
        </td>
    </tr>

{{endfor mensajes}}

</table>
