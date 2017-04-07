<h1>Ejemplo de Formulario</h1>
<form action="index.php?page=formulario"
      method="post">
    <label>Nombre</label>
    <input type="text" name="txtNombre"
        placeholder="Nombre Completo"
        value="{{txtNombre}}"/>
    <br/>
    <label>Correo</label>
    <input type="text" name="txtEmail"
        placeholder="correo@electroni.co"
        value="{{txtEmail}}"/></br>
     <button name="btnEnviar"
     onclick="enviarFormulario()">Enviar</button>
</form>
<div>
    {{msg}}
</div>
<script>
function enviarFormulario(){
    document.forms[0].submit();
}
</script>
