<link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<!-- NProgress -->
<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
<!-- iCheck -->
<link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
<!-- Datatables -->
<link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
<link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
<link href="build/css/custom.min.css" rel="stylesheet">
</head>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 align="center">Listado de Empresas</h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable-fixed-header" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>
                    Razon Social
                  </th>
                  <th>
                    Nombre Representante legal
                  </th>
                  <th>
                    Nombre Comercial
                  </th>
                  <th>
                    RTN
                  </th>
                  <th>
                     Numeros de Contratos
                  </th>
                  <th>
                    &nbsp;
                  </th>
                </tr>
                  </thead>
                  <tbody>
                   {{foreach tblempresa}}
                    <tr>
                     <td>
                       {{EmpresaNombre}}
                     </td>
                     <td>
                       {{EmpresaRepresentante}}
                     </td>
                     <td>
                       {{EmpresaComercial}}
                     </td>
                     <td>
                       {{EmpresaRTN}}
                     </td>
                     <td>
                       {{CantidadContratos}}
                     </td>
                     <td>
                       <a class="btn" title="Editar Empresa" role="button"
                         href="index.php?page=empresa2&mode=UPD&EmpresaCodigo={{EmpresaCodigo}}"
                        >
                         <span class="glyphicon glyphicon-edit"></span>
                       </a>
                       <a class="btn" title="Eliminar Empresa" role="button"
                        href="index.php?page=empresa2&mode=DLT&EmpresaCodigo={{EmpresaCodigo}}"
                       >
                      <span class="glyphicon glyphicon-trash"></span>
                       </a>
                       <a class="btn" title="Ver Contratos" role="button"
                        href="index.php?page=VerContratos&mode=Ver&EmpresaCodigo={{EmpresaCodigo}}"
                      >
                      <span class="glyphicon glyphicon-eye-open"></span>
                      </a>
                      <a class="btn" title="Agregar Contratos" role="button"
                        href="index.php?page=contrato&mode=AGR&EmpresaCodigo={{EmpresaCodigo}}"
                      >
                      <span class="glyphicon glyphicon-plus"></span>
                      </a>
                    </td>
                  </tr>
                  {{endfor tblempresa}}
                </tbody>
              </table>
             <div class="form-group" >
              <button id="btnExport" class="btn btn-success pull-left">Exportar a Excel</button>
               <a class="btn btn-primary pull-left" role="button"
                href="index.php?page=empresa&mode=INS">
                 <span class="glyphicon glyphicon-plus" ></span>
                  &nbsp;Agregar Empresa
           </a>
         </div>
             </div>
           </div>
         </div>
       

           <script src="vendors/fastclick/lib/fastclick.js"></script>
                             <!-- NProgress -->
           <script src="vendors/nprogress/nprogress.js"></script>
                             <!-- iCheck -->
           <script src="vendors/iCheck/icheck.min.js"></script>
                             <!-- Datatables -->
           <script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
           <script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
           <script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
           <script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
           <script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
           <script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
           <script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>


<script type="text/javascript">
    $("#btnExport").click(function(e) {
      e.preventDefault();


      var data_type = 'data:application/vnd.ms-excel';
      var table_div = document.getElementById('datatable-fixed-header');
      var table_html = table_div.outerHTML.replace(/ /g, '%20');

      var a = document.createElement('a');
      a.href = data_type + ', ' + table_html;
      a.download = 'exported_table_' + Math.floor((Math.random() * 9999999) + 1000000) + '.xls';
      a.click();
    });
</script>
