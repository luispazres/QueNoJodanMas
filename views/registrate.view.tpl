<script type="text/javascript">
  {{alerta}}
</script>
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
        <form id="defaultForm" action="index.php?page=registrate"  method="post" class="form-horizontal">
          <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12"> Nombre:</label>
             <div class="col-md-9 col-sm-9 col-xs-12">
                   <input type="text" class="form-control" name="txtUserName" id="txtUserName" value="{{txtUserName}}"/>
                 </div>
              </div>

                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12"> Apellido:</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">
                     <input type="text" class="form-control" name="txtApellido" id="txtApellido" value="{{txtApellido}}"/>
                    </div>
                </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Email:</label>
                 <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="text" class="form-control" name="txtEmail" id="txtEmail" placeholder="example@gmail.com" value="{{txtEmail}}"/>
                  </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Cargo:</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                <select class="form-control"  name="txtCargo" id="txtCargo">
                 {{foreach rol}}
                 <option value="{{rolCodigo}}" {{seleccionado}}>{{rolNombre}}</option>
                 {{endfor rol}}
               </select>
             </div>
          </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña:</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="password"  class="form-control" name="password" id="password" placeholder="x12589Ska" value="{{password}}"/>
              </div>
            </div>

             <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirme Contraseña:</label>
                  <div class="col-lg-5">
                    <input type="password" class="form-control" name="txtPasswordCnf" id="txtPasswordCnf" placeholder="x12589Ska"  value="{{txtPasswordCnf}}"/>
                  </div>
              </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type="submit" value="Regístrate" class="btn btn-success" style="margin-left:36%; margin-top: 15px;" name="btnRegistrar" style="margin-top: 15px;"/>

                  &nbsp;
                  <a href="index.php?page=usuarios" style="margin-top: 15px;" class="btn btn-warning" role="button" >Cancelar</a>
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
            txtUserName: {
                message: 'Este usuario es inválido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio.'
                    },
                    stringLength: {
                        min: 3,
                        max: 30,
                        message: 'El usuario debe tener entre 6 y 30 caracteres.'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'Solo se aceptan letras.'
                    }
                }
            },
            txtApellido: {
              validators: {
                  notEmpty: {
                      message: 'Campo obligatorio, no puede estr vacio.'
                  },
                  stringLength: {
                      min: 3,
                      max: 30,
                      message: 'El apellido debe tener entre 6 y 30 caracteres.'
                  },
                  regexp: {
                      regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                      message: 'Solo se aceptan letras.'
                  }
              }
          },
            txtEmail: {
                validators: {
                    notEmpty: {
                        message: 'El correo es un campo obligatorio no puede estar vacio.'
                    },
                    emailAddress: {
                        message: 'Formato de correo incorrecta.'
                    }
                }
            },
            txtCargo: {
               validators: {
                 notEmpty: {
                   message: 'Campo obligatorio no puede estar vacio.'
                 }
               }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Contraseña obligatoria no puede estar vacia.'
                    },
                    identical: {
                        field: 'txtPasswordCnf',
                        message: 'La contraseña y su confirmación no son los mismos'
                    }
                }
            },
            txtPasswordCnf: {
                validators: {
                    notEmpty: {
                        message: 'La contraseña de confirmación es obligatoria y no puede estar vacía'
                    },
                    identical: {
                        field: 'password',
                        message: 'La contraseña y su confirmación no son los mismos'
                    }
                }
            },
        }
    });
});
</script>