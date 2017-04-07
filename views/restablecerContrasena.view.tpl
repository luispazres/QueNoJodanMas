<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Restablecer Contraseña</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
              <form id="defaultForm" action="index.php?page=restablecerContrasena" method="post" class="form-horizontal">

                   <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12">Código:</label>
                       <div class="col-md-9 col-sm-9 col-xs-12">
                          <input class="col8" type="hidden" name="txtUsuarioCodigo"  value="{{usuarioCodigo}}" />
                          {{usuarioCodigo}}
                        </div>
                     </div>

                         <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva Contraseña:</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                            <input class="form-control" type="password" name="password" value="{{password}}" />
                          </div>
                        </div>

                        <div class="form-group">
                         <label class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar Contraseña:</label>
                          <div class="col-md-9 col-sm-9 col-xs-12">
                           <input class="form-control" type="password" name="txtPasswordCnf" value="{{txtPasswordCnf}}"/>
                         </div>
                       </div>

                       <div class="ln_solid"></div>
                       <div class="form-group">
                         <div class="col-md-9 col-sm-9 col-xs-12">
                            <input type="submit" class="btn btn-success" style="margin-left:36%; margin-top: 15px;" name="btnGuardar" value="Guardar" />
                            &nbsp;
                            <a href="index.php?page=usuarios" style="margin-top: 15px;" class="btn btn-warning" role="button" >Cancelar</a>
                                     <input type="hidden" name="returnUrl" value="{{returnUrl}}"/>
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
