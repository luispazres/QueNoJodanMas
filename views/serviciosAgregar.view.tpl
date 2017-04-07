<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Servicios</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        <form id="defaultForm" action="index.php?page=serviciosAgregar&mode={{mode}}&ServicioCodigo={{ServicioCodigo}}" method="post" class="form-horizontal">
          <div class="form-group">
             <label class="control-label col-md-3 col-sm-3 col-xs-12">Código:</label>
              {{if enabled}}
                <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="text" class="form-control" name="ServicioCodigo" value="{{ServicioCodigo}}"
                placeholder="Un Número" />
              </div>
              {{endif enabled}}
                {{ifnot enabled}}
                <b>{{ServicioCodigo}}</b>
                <input type="hidden" name="ServicioCodigo" value="{{ServicioCodigo}}"/>
                 {{endifnot enabled}}
            </div>

               <div class="form-group">
                 <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre de Servicio:</label>
                   {{ifnot deleting}}
                       <div class="col-md-9 col-sm-9 col-xs-12">
                        <input type="text" class="form-control" name="ServicioNombre" value="{{ServicioNombre}}"/>
                   </div>
                   {{endifnot deleting}}

                   {{if deleting}}
                       <b>{{ServicioNombre}}</b>
                       <input type="hidden" name="ServicioNombre" value="{{ServicioNombre}}"/>
                       {{endif deleting}}
                </div>

                <div class="ln_solid"></div>
               <div class="form-group">
                {{if deleting}}
                  <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                    <input type="submit" class="btn btn-primary" value="Eliminar" name="btnEliminar" />
                {{endif deleting}}
                {{ifnot deleting}}
                    <input type="submit"  class="btn btn-success" style="margin-left:36%;" value="Guardar" name="btnGuardar" />
                {{endifnot deleting}}
                &nbsp;
                <a href="index.php?page=servicios" class="btn btn-warning" role="button">Cancelar</a>
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
            ServicioNombre: {
                message: 'Nombre de Servicio no es válido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio'
                    },
                    stringLength: {
                        min:3,
                        max: 25,
                        message: 'Este campo debe tener al menos 6 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre de la empresa sólo puede consistir en letras.'
                    }
                }
            },
            ServicioCodigo: {
                message: 'Código no válido',
                validators: {
                    stringLength: {
                        min: 1,
                        max: 8,
                        message: 'El Código debe tener más de 1 y menos de 8 caracteres'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Solo se aceptan numeros.'
                    }
                }
            },
        }
    });
});
</script>













<!--﻿<head>
<link rel="stylesheet" href="public/vendor/bootstrap/css/bootstrap.css"/>
<link rel="stylesheet" href="public/dist/css/bootstrapValidator.css"/>
<script type="text/javascript" src="public/vendor/jquery/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="public/vendor/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="public/dist/js/bootstrapValidator.js"></script>
</head>
<form id="defaultForm" action="index.php?page=serviciosAgregar&mode={{mode}}&ServicioCodigo={{ServicioCodigo}}" method="post" class="form-horizontal">
  <div class="container">
      <div class="row">
          <section>
            <div class="col-lg-8 col-lg-offset-2">

                  <div class="form-group">
                      <label class="col-lg-3 control-label">Código:</label>
                    {{if enabled}}
                    <div class="col-lg-5">
                      <input type="text" class="form-control" name="ServicioCodigo" value="{{ServicioCodigo}}"
                        placeholder="Un Número" />
                    </div>
                    {{endif enabled}}

                    {{ifnot enabled}}
                      <b>{{ServicioCodigo}}</b>
                      <input type="hidden" name="ServicioCodigo" value="{{ServicioCodigo}}"/>
                    {{endifnot enabled}}
                </div>


                    <div class="form-group">
                      <label class="col-lg-3 control-label">Nombre de Servicio:</label>
                        {{ifnot deleting}}
                            <div class="col-lg-5">
                             <input type="text" class="form-control" name="ServicioNombre" value="{{ServicioNombre}}"/>
                        </div>
                        {{endifnot deleting}}

                        {{if deleting}}
                            <b>{{ServicioNombre}}</b>
                            <input type="hidden" name="ServicioNombre" value="{{ServicioNombre}}"/>
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
                 <a href="index.php?page=servicios" class="btn btn-warning" role="button">Cancelar</a>
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
            ServicioNombre: {
                message: 'Nombre de Servicio no es válido',
                validators: {
                    notEmpty: {
                        message: 'Campo obligatorio, no puede estar vacio'
                    },
                    stringLength: {
                        min: 6,
                        max: 25,
                        message: 'Este campo debe tener al menos 6 caracteres'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z_áéíóúñ\s]*$/,
                        message: 'El nombre de la empresa sólo puede consistir en letras.'
                    }
                }
            },
            ServicioCodigo: {
                message: 'Código no válido',
                validators: {
                    stringLength: {
                        min: 1,
                        max: 8,
                        message: 'El Código debe tener más de 1 y menos de 8 caracteres'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Solo se aceptan numeros.'
                    }
                }
            },
        }
    });
});
</script>
-->
