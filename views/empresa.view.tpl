<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Empresa</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-horizontal" id="defaultForm" action="index.php?page=empresa"  method="post">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de Empresa:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
               <input type="text" class="form-control" name="txtNombre" id="txtNombre" value="{{txtNombre}}"/>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre del Representante Legal:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="txtRepresentante" id="txtRepresentante" value="{{txtRepresentante}}"/>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre Comercial:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
            <input type="text" class="form-control" name="txtComercial" id="txtComercial" value="{{txtComercial}}"/>
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">RTN: <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="txtRTN" id="txtRTN" value="{{txtRTN}}"/>
            </div>
          </div>

          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
              <input type="submit" value="Guardar"  style="margin-top: 15px;" class="btn btn-primary" name="btnGuardar"/>

              &nbsp;
              <a href="index.php?page=listadoEmpresa" style="margin-top: 15px;" class="btn btn-warning" role="button" >Cancelar</a>
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
                txtNombre: {
                    message: 'El nombre de la empresa no es válido',
                    validators: {
                        notEmpty: {
                            message: 'Campo Obligatorio, no puede estar vacio'
                        },
                        stringLength: {
                            min: 3,
                            max: 25,
                            message: 'Debe tener mas de 6 y menos de 25 caracteres o números'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'El nombre de la empresa solo puede consistir en letras o números.'
                        }
                    }
                },
                txtRepresentante: {
                    message: 'El representante no es válido',
                    validators: {
                        notEmpty: {
                            message: 'Campo Obligatorio, no puede estar vacio'
                        },
                        stringLength: {
                            min: 3,
                            max: 25,
                            message: 'Debe contener entre 3 a 25 caracteres.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                            message: 'Solo se admiten letras.'
                        }
                    }
                },
                txtComercial: {
                    message: 'El nombre comercial no es válido',
                    validators: {
                        notEmpty: {
                            message: 'Campo Obligatorio, no puede estar vacio'
                        },
                        stringLength: {
                            min: 4,
                            max: 25,
                            message: 'Debe estar comprendido entre 4 a 25 letras o números.'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'Solo se admiten letras o números.'
                        }
                    }
                },
                txtRTN: {
                    message: 'RTN no válido',
                    validators: {
                        notEmpty: {
                            message: 'Campo Obligatorio, no puede estar vacio'
                        },
                        stringLength: {
                            min: 6,
                            max: 20,
                            message: 'Debe estar comprendido entre 6 a 20 caracteres y números'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                            message: 'Solo se admiten letras y números'
                        }
                    }
                },
            }
        });
    });
    </script>