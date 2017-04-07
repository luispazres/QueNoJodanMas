<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Registro de Usuarios</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        <form id="defaultForm" action="index.php?page=usuarios2&mode={{mode}}&usuarioCodigo={{usuarioCodigo}}" method="post" class="form-horizontal">
           {{datos}}
            <div class="form-group">
               <label class="col-lg-3 control-label"> Código:</label>
                     {{if enabled}}
                      <div class="col-md-9 col-sm-9 col-xs-12">
                       <input type="text" class="form-control" name="usuarioCodigo" value="{{usuarioCodigo}}" placeholder="Un Número" />
                   </div>
                     {{endif enabled}}
                 {{ifnot enabled}}
                       <b>{{usuarioCodigo}}</b>
                       <input type="hidden" name="usuarioCodigo" value="{{usuarioCodigo}}"/>
                     {{endifnot enabled}}
              </div>

              <div class="form-group">
                <label class="col-lg-3 control-label">Nombre:</label>
                    {{ifnot deleting}}
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="usuarioNombre" value="{{usuarioNombre}}"/>
                     </div>
                    {{endifnot deleting}}

                    {{if deleting}}
                        <b>{{usuarioNombre}}</b>
                        <input type="hidden" name="usuarioNombre" value="{{usuarioNombre}}"/>
                    {{endif deleting}}
             </div>

            <div class="form-group">
              <label class="col-lg-3 control-label">Apellido:</label>
                    {{ifnot deleting}}
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="usuarioApellido" value="{{usuarioApellido}}"/>
                    </div>
                    {{endifnot deleting}}

                    {{if deleting}}
                        <b>{{usuarioApellido}}</b>
                        <input type="hidden" name="usuarioApellido" value="{{usuarioApellido}}"/>
                    {{endif deleting}}
            </div>


            <div class="form-group">
              <label class="col-lg-3 control-label">Correo:</label>
                    {{ifnot deleting}}
                      <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="usuarioCorreo" value="{{usuarioCorreo}}"/>
                      </div>
                    {{endifnot deleting}}</br>

                    {{if deleting}}
                        <b>{{usuarioCorreo}}</b>
                        <input type="hidden" name="usuarioCorreo" value="{{usuarioCorreo}}"/>
                    {{endif deleting}}
             </div>


                <div class="form-group">
                  <label class="col-lg-3 control-label">Cargo:</label>
    		        {{ifnot deleting}}
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="rolCodigo" id="rolCodigo">
                     {{foreach roles}}
                       <option value="{{rolCodigo}}" >{{rolNombre}}</option>
                     {{endfor roles}}
                  </select>
                </div>
    			     {{endifnot deleting}}

    			    {{if deleting}}
               <b>{{rolNombre}}</b>
               <input type="hidden" name="rolCodigo" value="{{rolNombre}}"/>
            {{endif deleting}}
        </div>

            <div class="ln_solid"></div>
              <div class="form-group">
                {{if deleting}}
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="submit" class="btn btn-primary" style="margin-left:27%;" value="Eliminar" name="btnEliminar" />
                {{endif deleting}}
                {{ifnot deleting}}
                    <input type="submit"  class="btn btn-success" style="margin-left:27%;" value="Guardar" name="btnGuardar" />
                {{endifnot deleting}}
                &nbsp;
                <a href="index.php?page=usuarios" class="btn btn-warning" role="button">Cancelar</a>
            </div>
          </div>
          </form>
        </div>
     </div>
   </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usuarioNombre: {
                message: 'El usuario no es válido',
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio, no puede estar vacio.'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'El nombre de usuario debe tener más de 3 y menos de 30 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'Solo se admiten letras.'
                    }
                }
            },
            usuarioApellido: {
              message: 'Apellido no válido',
              validators: {
                  notEmpty: {
                      message: 'El campo es obligatorio, no puede estar vacio.'
                  },
                  stringLength: {
                      min: 6,
                      max: 30,
                      message: 'El apellido debe tener más de 3 y menos de 30 caracteres'
                  },
                  regexp: {
                      regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                      message: 'Solo se admiten letras.'
                  }
              }
          },
            usuarioCorreo: {
                validators: {
                    notEmpty: {
                        message: 'El campo obligatorio, no puede estar vacio.'
                    },
                    emailAddress: {
                        message: 'La entrada no es una dirección de correo electrónico válida.'
                    }
                }
            },
            rolCodigo: {
               validators: {
                 notEmpty: {
                   message: 'El campo es obligatorio, no puede estar vacio.'
               }
             }
           },
         }
     });
 });
</script>

<!--<head>
<link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<div class="container">
      <div class="row">
        <section>
            <div class="col-lg-8 col-lg-offset-2">
              <form id="defaultForm" action="index.php?page=usuarios2&mode={{mode}}&usuarioCodigo={{usuarioCodigo}}" method="post" class="form-horizontal">
                 {{datos}}

                 <div class="form-group">
                    <label class="col-lg-3 control-label"> Código:</label>
                          {{if enabled}}
                           <div class="col-lg-5">
                            <input type="text" class="form-control" name="usuarioCodigo" value="{{usuarioCodigo}}" placeholder="Un Número" />
                        </div>
                          {{endif enabled}}

                          {{ifnot enabled}}
                            <b>{{usuarioCodigo}}</b>
                            <input type="hidden" name="usuarioCodigo" value="{{usuarioCodigo}}"/>
                          {{endifnot enabled}}
                   </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Nombre:</label>
                {{ifnot deleting}}
                <div class="col-lg-5">
                  <input type="text" class="form-control" name="usuarioNombre" value="{{usuarioNombre}}"/>
                 </div>
                {{endifnot deleting}}

                {{if deleting}}
                    <b>{{usuarioNombre}}</b>
                    <input type="hidden" name="usuarioNombre" value="{{usuarioNombre}}"/>
                {{endif deleting}}
         </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Apellido:</label>
                {{ifnot deleting}}
                <div class="col-lg-5">
                  <input type="text" class="form-control" name="usuarioApellido" value="{{usuarioApellido}}"/>
                </div>
                {{endifnot deleting}}

                {{if deleting}}
                    <b>{{usuarioApellido}}</b>
                    <input type="hidden" name="usuarioApellido" value="{{usuarioApellido}}"/>
                {{endif deleting}}
        </div>


        <div class="form-group">
          <label class="col-lg-3 control-label">Correo:</label>
                {{ifnot deleting}}
                  <div class="col-lg-5">
                    <input type="text" class="form-control" name="usuarioCorreo" value="{{usuarioCorreo}}"/>
                  </div>
                {{endifnot deleting}}</br>

                {{if deleting}}
                    <b>{{usuarioCorreo}}</b>
                    <input type="hidden" name="usuarioCorreo" value="{{usuarioCorreo}}"/>
                {{endif deleting}}
         </div>


            <div class="form-group">
              <label class="col-lg-3 control-label">Cargo:</label>
		        {{ifnot deleting}}
              <div class="col-lg-5">
                <select class="form-control" name="rolCodigo" id="rolCodigo">
                 {{foreach roles}}
                   <option value="{{rolCodigo}}" >{{rolNombre}}</option>
                 {{endfor roles}}
              </select>
            </div>
			     {{endifnot deleting}}

			    {{if deleting}}
           <b>{{rolNombre}}</b>
           <input type="hidden" name="rolCodigo" value="{{rolNombre}}"/>
        {{endif deleting}}
    </div>

          <div class="form-group">
            {{if deleting}}
            <div class="col-lg-9 col-lg-offset-3">
                <input type="submit" class="btn btn-primary" value="Eliminar" name="btnEliminar" />
              </div>
            {{endif deleting}}
            {{ifnot deleting}}
                <input type="submit"  class="btn btn-primary" value="Guardar" name="btnGuardar" />
            {{endifnot deleting}}
            &nbsp;
            <a href="index.php?page=usuarios" class="btn btn-warning" role="button">Cancelar</a>
        </div>
      </form>
    </div>
 </section>
 </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            usuarioNombre: {
                message: 'El usuario no es válido',
                validators: {
                    notEmpty: {
                        message: 'El campo es obligatorio, no puede estar vacio.'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'El nombre de usuario debe tener más de 3 y menos de 30 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'Solo se admiten letras.'
                    }
                }
            },
            usuarioApellido: {
              message: 'Apellido no válido',
              validators: {
                  notEmpty: {
                      message: 'El campo es obligatorio, no puede estar vacio.'
                  },
                  stringLength: {
                      min: 6,
                      max: 30,
                      message: 'El apellido debe tener más de 3 y menos de 30 caracteres'
                  },
                  regexp: {
                      regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                      message: 'Solo se admiten letras.'
                  }
              }
          },
            usuarioCorreo: {
                validators: {
                    notEmpty: {
                        message: 'El campo obligatorio, no puede estar vacio.'
                    },
                    emailAddress: {
                        message: 'La entrada no es una dirección de correo electrónico válida.'
                    }
                }
            },
            rolCodigo: {
               validators: {
                 notEmpty: {
                   message: 'El campo es obligatorio, no puede estar vacio.'
               }
             }
           },
         }
     });
 });
</script> -->
