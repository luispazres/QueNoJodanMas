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
            <h2 align="center">Usuarios</h2>
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
                    Nombre
                  </th>
                  <th>
                    Apellido
                  </th>
                  <th>
                    Correo
                  </th>
                  <th>
                    Cargo
                  </th>
                  <th>
                   <center><i class="fa fa-wrench"></i></center>
                  </th>
                </tr>
              </thead>
                  <tbody>
                {{foreach tblusuarios}}
               <tr>
                 <td>
                   {{usuarioNombre}}
                 </td>
                 <td>
                   {{usuarioApellido}}
                 </td>
                 <td>
                   {{usuarioCorreo}}
                 </td>
                 <td>
                   {{Cargo}}
                 </td>
                 <td>
                  <center>
                   <a class="btn" title="Editar Usuario" role="button"
                     href="index.php?page=usuarios2&mode=UPD&usuarioCodigo={{usuarioCodigo}}"
                   >
                     <span class="glyphicon glyphicon-pencil"></span>
                   </a>
                   <a class="btn" title="Eliminar Usuario" role="button"
                     href="index.php?page=usuarios2&mode=DLT&usuarioCodigo={{usuarioCodigo}}"
                   >
                     <span class="glyphicon glyphicon-trash"></span>
                   </a>
                   <a class="btn" title="Eliminar Usuario" role="button"
                    href="index.php?page=restablecerContrasena&mode=RTC&usuarioCodigo={{usuarioCodigo}}"
                    >
                   <span class="glyphicon glyphicon-cog"></span>
                   </a>
                 </center>
                  </td>
                </tr>
              {{endfor tblusuarios}}
            </tbody>
          </table>
          <a class="btn btn-primary pull-left" role="button"
           href="index.php?page=registrate&mode=INS">
           <span class="glyphicon glyphicon-plus"></span>
           &nbsp;Agregar Usuario
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
