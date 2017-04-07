<link rel="stylesheet" href="public/css/bootstrap-datepicker.min.css">
<script type="text/javascript" src="public/js/bootstrap-datepicker.es.min.js"> </script>
<script type="text/javascript" src="public/js/bootstrap-datepicker.min.js"> </script>

﻿<div class="row">
  <div class="col-md-6 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Nuevo Contrato</h2>
        <ul class="nav navbar-right panel_toolbox">
          <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
          </li>
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        <form id="defaultForm" action="index.php?page=contrato"  method="post" class="form-horizontal" enctype="multipart/form-data">

          <input type="hidden" name="contratoCodigo" value="{{ContratoCodigo}}">

           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"> EmpresaCodigo:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
             <input type="hidden" class="form-control" name="txtCodEmpresa" id="txtCodEmpresa" value="{{datos}}" >
             {{datos}}
           </div>
        </div>

         <div class="form-group">
          <label class="control-label col-md-3 col-sm-3 col-xs-12">Valor del Contrato:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" class="form-control" name="txtValor" id="txtValor" value="{{txtValor}}" >
        </div>
     </div>

     <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Moneda:</label>
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
               <label class="control-label col-md-3 col-sm-3 col-xs-12">Vigencia de Contrato:</label>
               <div class="col-md-9 col-sm-9 col-xs-12">
              <select class="form-control" name="txtVigencia" id="txtVigencia">
                {{foreach vigencia}}
                <option value="{{VigenciaCodigo}}">{{VigenciaMeses}}</option>
                {{endfor vigencia}}
              </select>
            </div>
         </div>

               <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha Inicial del Contrato:</label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <input type='text' class="form-control" data-language='en' name="fechaInicial" data-position="right top"  id="fechaInicial" value="{{fechaInicial}}"/>

              </div>
            </div>


                <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Fecha de Vencimiento Contrato:</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type='text' class="form-control" data-language='en'  name="fechaVencimiento" data-position="right top"  id="fechaVencimiento" value="{{fechaVencimiento}}"/>

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
              <hr>

              <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="file" name="userfile[]" id="userfile" class="form-control"/></br>
                  </div>

              <hr>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12">
                <input type="submit" value="Guardar"  class="btn btn-success" style="margin-left:27%;" name="btnGuardar"/>

                &nbsp;
                <a href="index.php?page=listadoEmpresa" class="btn btn-warning" role="button" >Cancelar</a>
              </div>
            </div>
          </form>
        </div>
     </div>
  </div>
 </div>

 <script type="text/javascript">

 $('#fechaInicial').datepicker({
   format: "yy-mm-dd",
   startDate:"today"
 });


   function getMonth(date) {
     var month = date.getMonth() + 1;
     return month < 10 ? '0' + month : '' + month;
   }

   $('#fechaInicial').change(function(){
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

     var fechaInicial=$("#fechaInicial").val();
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

     $("#fechaVencimiento").val(res);

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
           txtValor: {
               message: 'Valor del Contrato no válido',
               validators: {
                   notEmpty: {
                       message: 'Este campo es obligatorio y no puede estar vacio.'
                   },
                   stringLength: {
                       min: 3,
                       max: 8,
                       message: 'Debe contener entre 3 y 8 números.'
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
           fechaInicial: {
              validators: {
                notEmpty: {
                  message: 'Este campo es obligatorio y no puede estar vacio.'
                }
              }
           },
           userfile: {

             validators: {

               file: {

                  extension: 'pdf',

                  type: 'application/pdf',

                  maxSize: 10*1024*1024,

                  message: 'Please choose a pdf file with a size less than 10M.'

                  }

               }

            },

          }
     })
 });
 </script>
