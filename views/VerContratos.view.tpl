<head>
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

  <!-- Custom Theme Style -->
  <link href="build/css/custom.min.css" rel="stylesheet">
</head>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_title">
              <h2 align="center">Directorio de Contratos</h2>
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
                    <th>Contrato Codigo</th>
                    <th>Fecha de Ingreso</th>
                    <th>Fecha de Vencimiento</th>
                    <th>Contrato Vigencia</th>
                    <th>Valor Contrato</th>
                    <th>Moneda</th>
                    <th>Tipo de Servicios</th>
                    <th>Estado</th>
                    <th>Nombre del Documento</th>
                    <th><i class="fa fa-wrench"></i></th>
                    </tr>
                </thead>
                <tbody>
                  {{foreach tblcontratos}}
                <form method="post" action="index.php?page=VerContratos" >
                    <tr>
                      <td>{{ContratoCodigo}}</td>
                      <td>{{ContratoFechaInicio}}</td>
                      <td>{{ContratoFechaFinal}}</td>
                      <td> {{VigenciaMeses}}</td>
                      <td>{{ContratoValor}}</td>
                      <td>{{MonedaNombre}}</td>
                      <td>{{Servicios}}</td>
                      <td>{{EstadoNombre}}</td>
                     <td>
                       <a href="index.php?page=vista&DocumentoDireccion={{NombredelContrato}}" target="_blank">{{NombredelContrato}}</a>
                     </td>
                     <td>
                       <a href="index.php?page=VerContratos&DocumentoDireccion={{NombredelContrato}}" class="btn" title="Descargar Contrato" role="button">
                         <span class="glyphicon glyphicon-cloud-download"></span>
                       </a>
                       <a class="btn" title="Editar contrato" role="button"
                         href="index.php?page=contratoEdicion&mode=UPD&ContratoCodigo={{ContratoCodigo}}&EmpresaCodigo={{EmpresaCodigo}}"
                       >
                         <span class="glyphicon glyphicon-edit"></span>
                       </a>
                       <a class="btn" title="Eliminar contrato" role="button"
                         href="index.php?page=VerContratos&mode=DLT&ContratoCodigo={{ContratoCodigo}}&EmpresaCodigo={{EmpresaCodigo}}"
                       >
                         <span class="glyphicon glyphicon-trash"></span>
                       </a>
                     </td>
                   </tr>
                   </form>
                   {{endfor tblcontratos}}
                </tbody>
              </table>
            <a class="btn btn-primary pull-left" role="button"
            href="index.php?page=listadoEmpresa&mode=INS">
              <span class="glyphicon glyphicon-chevron-left"></span>
               &nbsp;Regresar
        </a>
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
