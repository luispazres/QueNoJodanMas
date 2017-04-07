<link rel="stylesheet" href="public/css/bootstrap-datepicker.min.css">
<script type="text/javascript" src="public/js/bootstrap-datepicker.es.min.js"> </script>
<script type="text/javascript" src="public/js/bootstrap-datepicker.min.js"> </script>

<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Editar Contrato</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        <form id="defaultForm" action="index.php?page=contratoEdicion&mode=UPD" method="post" class="form-horizontal">
        <div class="form-group">
          <label class="col-lg-3 control-label">Código:</label>
            <div class="col-lg-5">
              <input type="hidden" name="txtEmpresaCodigo" value="{{empresaCodigo}}">
              <input type="hidden" name="txtCodContrato" value="{{contratoCodigo}}">
               {{contratoCodigo}}
           </div>
        </div>


         <div class="form-group">
           <label class="col-lg-3 control-label">Vigencia del Contrato:</label>
              <div class="col-lg-5">
                      <select class="form-control" name="txtVigencia" id="txtVigencia">
                        {{foreach vigencias}}
                          <option value="{{VigenciaCodigo}}">{{VigenciaMeses}}</option>
                        {{endfor vigencias}}
                      </select>
              </div>
          </div>

          <div class="form-group">
            <label class="col-lg-3 control-label">Valor del Contrato:</label>
               <div class="col-lg-5">
                  <input type="text"  class="form-control" name="ContratoValor" id="ContratoValor" value="{{ContratoValor}}"/>
                   {{ContratoValor}}
                 </div>
             </div>

             <div class="form-group">
               <label class="col-lg-3 control-label">Moneda:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
               <div class="radio">
                 <label>
                   <input type="radio" class="flat" checked name="txtMoneda" value="1"> Lempira
                 </label>
               </div>
               <div class="radio">
                 <label>
                   <input type="radio" class="flat" name="txtMoneda" value="2"> Dolar
                 </label>
               </div>
               </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Seleccione los Servicios</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="select2_multiple form-control" multiple="multiple" id="txtServicio[]" name="txtServicio[]">
                      {{foreach servicio}}
                      <option value="{{ServicioCodigo}}">{{ServicioNombre}}</option>
                      {{endfor servicio}}
                    </select>
                  </div>
                </div>

             <div class="form-group">
               <label class="col-lg-3 control-label">Fecha Inicial del Contrato:</label>
                  <div class="col-lg-5">
                    <input type="text"  class="form-control" name="ContratoFechaInicio" id="ContratoFechaInicio" value=""/>
                  </div>
               </div>

               <div class="form-group">
                 <label class="col-lg-3 control-label">Fecha de Vencimiento del Contrato:</label>
                    <div class="col-lg-5">
                    <input type="text" class="form-control"  name="ContratoFechaFinal" id="ContratoFechaFinal" value=""/>
                    {{ContratoFechaFinal}}
                  </div>
               </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado:</label>
                 <div class="col-md-9 col-sm-9 col-xs-12">
                 <select class="form-control"  id="txtEstado" name="txtEstado">
                 {{foreach estados}}
                 <option value="{{EstadoCodigo}}">{{EstadoNombre}}</option>
                 {{endfor estados}}
               </select>
             </div>
          </div>

               <div class="ln_solid"></div>
               <div class="form-group">
                 <div class="col-lg-9 col-lg-offset-3">
                   <td colspan="2" style="text-align:right">
                     <input type="submit"  class="btn btn-success" value="Guardar" name="btnGuardar" />

                &nbsp;
                <a href="index.php?page=VerContratos&mode=Ver&EmpresaCodigo={{empresaCodigo}}" class="btn btn-warning" role="button">Cancelar</a>
              </div>
            </div>
        </form>
      </div>
   </div>
</div>
</div>


<script type="text/javascript">

$('#ContratoFechaInicio').datepicker({
  format: "yy-mm-dd",
  startDate:"today"
});


function getMonth(date) {
  var month = date.getMonth() + 1;
  return month < 10 ? '0' + month : '' + month;
}

$('#ContratoFechaInicio').change(function(){
  var vigencia=$("#txtVigencia").val();
  var vigenciaMeses;
  switch (vigencia) {
    case "1":
      vigenciaMeses=3;
      break;
    case "2":
      vigenciaMeses=6;
      break;
    case "3":
      vigenciaMeses=9;
      break;
    case "4":
      vigenciaMeses=12;
      break;
    case "5":
      vigenciaMeses=18;
      break;
    case "6":
      vigenciaMeses=24;
      break;
  }

  var fechaInicial=$("#ContratoFechaInicio").val();
  var date = new Date();
  var dateArray = fechaInicial.split("-");
  date.setFullYear(parseInt(dateArray[0]));
  date.setMonth(parseInt(dateArray[1])-1);
  date.setDate(parseInt(dateArray[2]));
  var fechaFinal=new Date();
  fechaFinal.setFullYear(date.getFullYear());
  fechaFinal.setDate(date.getDate());
  fechaFinal.setMonth(date.getMonth()+parseInt(vigenciaMeses));

  var anio = String(fechaFinal.getFullYear());
  var month= String(getMonth(fechaFinal));
  var dia= String(fechaFinal.getDate());
  var res= anio.concat("-",month,"-",dia);

  $("#ContratoFechaFinal").val(res);

});


$(document).ready(function() {
    $('#defaultForm').bootstrapValidator({
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            ContratoValor: {
                message: 'Valor del contrato inválido',
                validators: {
                    notEmpty: {
                        message: 'Este campo es obligatorio y no puede estar vacio.'
                    },
                    stringLength: {
                        min: 3,
                        max: 8,
                        message: 'Este campo debe estar comprendido entre 5 y 8 cifras.'
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'Solo se aceptan números.'
                    }
                }
            },
            txtServicio: {
               validators: {
                 notEmpty: {
                   message: 'Este campo es obligatorio y no puede estar vacio.'
                 }
               }
            },
            txtVigencia: {
               validators: {
                 notEmpty: {
                   message: 'Este campo es obligatorio y no puede estar vacio.'
                 }
               }
            },
            ContratoFechaInicio: {
               validators: {
                 notEmpty: {
                   message: 'Este campo es obligatorio y no puede estar vacio.'
                 }
               }
            },
        }
    });
});
</script>
