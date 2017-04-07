<h1>Gestión de Mensajes</h1>
<a href="index.php?page=mensajes">Regresar</a>
<hr/>
<form action="index.php?page=mensajeform" method="post">
    <input type="hidden" name="msgid" value="{{msgid}}"/>
    <input type="hidden" name="formMode" value="{{formMode}}"/>
    <div>
        <label>Mensaje</label>
        <br/>
        <textarea name="msgdsc"
            {{if msgdscdisable}} disabled {{endif msgdscdisable}}>{{msgdsc}}</textarea>
    </div>
    <div>
        <button onclick="btnSubmit">Guardar</button>
    </div>
</form>
<div class="errorblock">
    {{foreach errors}}
        {{error}} <br/>
    {{endfor errors}}
</div>
<script>
    function btnSubmit(e){
        //validacion a nivel cliente
        document.forms[0].submit();
    }
</script>
