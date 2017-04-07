<?php
//middleware de configuración de todo el sitio
require_once("models/contratos.model.php");
require_once("models/alertas.model.php");
require_once("clases/PHPMailerAutoload.php");
require_once("clases/class.phpmailer.php");
require_once("clases/class.phpmaileroauth.php");
require_once("clases/class.smtp.php");
require_once("clases/class.pop3.php");
require_once("clases/class.phpmaileroauthgoogle.php");
function site_init(){

  $contratos="";
  $contratosAVencer = array( );
  $contratosVencidos = array( );
  $dia="95";
  $mes="";
  $anio="";
  $resta=0;
  $mensaje="";
  $convertedDate="";
  $hoy=date('Y-m-d');
  $hoyObjeto= new DateTime(date('Y-m-d H:i:s'));
  $today_time = strtotime($hoy);
  $cont=0;
  $fecha=array();
  $today=array("mes"=>date("m"),"anio"=>date("Y"),"dia"=>date("d"));
  $alert=$today['anio']."-".$today["mes"]."-".$today["dia"];
  $contratosHeader="";

  $contratos=obtenerTodosLosContratos();

  foreach ($contratos as $key) {

  $convertedDate=strtotime($key["ContratoFechaFinal"]);
  $vencimientoObjeto = new DateTime(date($key["ContratoFechaFinal"]));
  $dia = date('d',$convertedDate);
  $mes = date('m',$convertedDate);
  $anio= date('Y',$convertedDate);

  $interval = $hoyObjeto->diff($vencimientoObjeto);

  //echo "Dias: ".$interval->format('%R%a días')." || ";

  if ($key["ContratoFechaFinal"]<=$hoy) {
    $contratosVencidos[]=$key;
  }

  if ($interval->days==14) {
    $contratosAVencer[]=$key;
  }

  if ($interval->days==29) {

  $contratosAVencer[]=$key;
  }

  if ($interval->days==6) {

  $contratosAVencer[]=$key;
  }
}

foreach ($contratosVencidos as $key) {
  $cont++;

  $contratosHeader.="  <li>
      <a>
        <span class='image'><img src='public/imgs/contrato1.png' alt='Profile Image'></span>
        <span>
          <span>Alerta de Vencimiento</span>
          <span class='time'>".$key["ContratoFechaFinal"]."</span>
        </span>
        <span class='message'>
          El contrato #".$key["ContratoCodigo"]." de la empresa ".$key["EmpresaNombre"]." esta vencido.
        </span>
      </a>
    </li>";
}

  foreach ($contratosAVencer as $key) {
    $cont++;

    $contratosHeader.="  <li>
        <a>
          <span class='image'><img src='public/imgs/contrato1.png' alt='Profile Image'></span>
          <span>
            <span>Alerta de Vencimiento</span>
            <span class='time'>".$key["ContratoFechaFinal"]."</span>
          </span>
          <span class='message'>
            El contrato #".$key["ContratoCodigo"]." de la empresa ".$key["EmpresaNombre"]." esta por vencer.
          </span>
        </a>
      </li>";
  }

  if (!obtenerAlerta($alert)) {
      insertarAlerta($alert);
    $contratos=obtenerTodosLosContratos();

    foreach ($contratos as $key) {

      $convertedDate=strtotime($key["ContratoFechaFinal"]);
      $vencimientoObjeto = new DateTime(date($key["ContratoFechaFinal"]));
      $dia = date('d',$convertedDate);
      $mes = date('m',$convertedDate);
      $anio= date('Y',$convertedDate);

      $interval = $hoyObjeto->diff($vencimientoObjeto);

    if ($interval->days==29) {

      $serviciosDetalles=obtenerServiciosPorEmpresaSite($key["ContratoCodigo"]);
      $serviciosConcatenar="";

      foreach ($serviciosDetalles as $key) {
          $serviciosConcatenar.=$key["ServicioNombre"]." ";
      }

    $mail = new PHPMailer;

    $mensaje="
 <body style='margin:0; padding:0'>
  <table  border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td>
        <table  align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>
          <tr>
            <td align='center' style='padding: 45px 0 0 0;'>
              <img src='http://www.soyservidor.com/site/wp-content/uploads/2014/02/ss-logo-8bits.png'  width='48%' height='101'  style='display: block;' />
            </td>
          </tr>
          <tr>
            <td bgcolor='#ffffff' style='padding: 6px 30px 40px 30px;' >
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                       <tr>
                         <td width='180' valign='top'>
                           <table>
                             <tr>
                               <td bgcolor='#ee4c50'>
                                <h2 align='center';  style='color:#FBF8EF';>Alertas</h2>
                               </td>
                              </tr>
                              <tr>
                                <td bgcolor='#e8ecf2' style='font-size:14px; padding: 37px 0 37px 0; text-align: center; color:#3c543f'>
                                    Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]."con servicios: ".$serviciosConcatenar.". tiene 29 dias de vigencia antes de su vencimiento
                                    <a style='padding-left: 64%;' href='http://166.63.123.107/~prueba/proyectosoyservidor-master/index.php?page=login2'  role='button'>Ir al sitio</a>
                                </td>
                              </tr>
                           </table>
                         </td>
                        <td width='7%' valign='top'>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
 </body>";

    $mail->SMTPDebug=2;
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = false;
    $mail->Username = 'desarrollojr@soyservidor.com';
    $mail->Password = 'soyservidor2017';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465 ;

    $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
    $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');
    //$mail->addAddress('ellen@example.com');
    $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Alerta de vencimiento de contrato';
    $mail->Body    = $mensaje;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        //echo 'Message could not be sent.';
        //echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        //echo 'Message has been sent';
    }
  }


if ($interval->days==14) {

  $serviciosDetalles=obtenerServiciosPorEmpresaSite($key["ContratoCodigo"]);
  $serviciosConcatenar="";

  foreach ($serviciosDetalles as $key) {
      $serviciosConcatenar.=$key["ServicioNombre"]." ";
  }

      $mail = new PHPMailer;

      $mensaje="<body style='margin:0; padding:0'>
  <table  border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td>
        <table  align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>
          <tr>
            <td align='center' style='padding: 45px 0 0 0;'>
              <img src='http://www.soyservidor.com/site/wp-content/uploads/2014/02/ss-logo-8bits.png'  width='48%' height='101'  style='display: block;' />
            </td>
          </tr>
          <tr>
            <td bgcolor='#ffffff' style='padding: 6px 30px 40px 30px;' >
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                       <tr>
                         <td width='180' valign='top'>
                           <table>
                             <tr>
                               <td bgcolor='#ee4c50'>
                                <h2 align='center';  style='color:#FBF8EF';>Alertas</h2>
                               </td>
                              </tr>
                              <tr>
                                <td bgcolor='#e8ecf2' style='font-size:14px; padding: 37px 0 37px 0; text-align: center; color:#3c543f'>
                                    Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]." con servicios: ".$serviciosConcatenar.". tiene 15 dias de vigencia antes de su vencimiento.
                                    <a style='padding-left: 64%;' href='http://166.63.123.107/~prueba/proyectosoyservidor-master/index.php?page=login2'  role='button'>Ir al sitio</a>
                                </td>
                              </tr>
                           </table>
                         </td>
                        <td width='7%' valign='top'>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
 </body>";

      //$mail->isSMTP();
      $mail->SMTPDebug=2;
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = false;
      $mail->Username = 'desarrollojr@soyservidor.com';
      $mail->Password = 'soyservidor2017';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 465 ;                                    // TCP port to connect to

      $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
      $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');        // Add a recipient
      //$mail->addAddress('ellen@example.com');               // Name is optional
      $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
      //$mail->addCC('cc@example.com');
      //$mail->addBCC('bcc@example.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Alerta de vencimiento.';
      $mail->Body    = $mensaje;
      $mail->AltBody = 'El contrato #'.$key["ContratoCodigo"].' de la empresa '.$key["EmpresaNombre"].' con servicio '.$key["ServicioNombre"].' esta a 15 dias de expirar.';

      if(!$mail->send()) {
          //echo 'Message could not be sent.';
          //echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          //echo 'Message has been sent';
      }
      }


  if ($interval->days==6) {
      $mail = new PHPMailer;

       $mensaje="
       <body style='margin:0; padding:0'>
  <table  border='0' cellpadding='0' cellspacing='0' width='100%'>
    <tr>
      <td>
        <table  align='center' border='0' cellpadding='0' cellspacing='0' width='600' style='border-collapse: collapse;'>
          <tr>
            <td align='center' style='padding: 45px 0 0 0;'>
              <img src='http://www.soyservidor.com/site/wp-content/uploads/2014/02/ss-logo-8bits.png'  width='48%' height='101'  style='display: block;' />
            </td>
          </tr>
          <tr>
            <td bgcolor='#ffffff' style='padding: 6px 30px 40px 30px;' >
              <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                <tr>
                  <td>
                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                       <tr>
                         <td width='180' valign='top'>
                           <table>
                             <tr>
                               <td bgcolor='#ee4c50'>
                                <h2 align='center';  style='color:#FBF8EF';>Alertas</h2>
                               </td>
                              </tr>
                              <tr>
                                <td bgcolor='#e8ecf2' style='font-size:14px; padding: 37px 0 37px 0; text-align: center; color:#3c543f'>
                                    Alerta de vencimiento\n\n El contrato #".$key["ContratoCodigo"]." con servicios: ".$serviciosConcatenar.". tiene 5 dias de vigencia antes de su vencimiento
                                    <a style='padding-left: 64%;' href='http://166.63.123.107/~prueba/proyectosoyservidor-master/index.php?page=login2'  role='button'>Ir al sitio</a>
                                </td>
                              </tr>
                           </table>
                         </td>
                        <td width='7%' valign='top'>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
 </body>";

       //$mail->isSMTP();
       $mail->SMTPDebug=2;
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = false;
       $mail->Username = 'desarrollojr@soyservidor.com';
       $mail->Password = 'soyservidor2017';                           // SMTP password
       $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
       $mail->Port = 465 ;                                    // TCP port to connect to

       $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
       $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');         // Add a recipient
       //$mail->addAddress('ellen@example.com');               // Name is optional
       $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
       //$mail->addCC('cc@example.com');
       //$mail->addBCC('bcc@example.com');

       //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
       $mail->isHTML(true);                                  // Set email format to HTML

       $mail->Subject = 'Alerta de vencimiento';
       $mail->Body    = $mensaje;
       $mail->AltBody = 'El contrato #'.$key["ContratoCodigo"].' de la empresa '.$key["EmpresaNombre"].' con servicio '.$key["ServicioNombre"].' esta a 7 dias de expirar.';

       if(!$mail->send()) {
           //echo 'Message could not be sent.';
           //echo 'Mailer Error: ' . $mail->ErrorInfo;
       } else {
          // echo 'Message has been sent';
       }
     }

         }

     insertarAlerta($alert);
    }

if(mw_estaLogueado()){
  if ($_SESSION["rol"]==1) {
    $navbar="
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>

        <title>SoyServidor </title>

        <!-- Bootstrap -->

        <!-- Font Awesome -->
        <link href='vendors/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
        <!-- NProgress -->
        <link href='vendors/nprogress/nprogress.css' rel='stylesheet'>
        <!-- jQuery custom content scroller -->
        <link href='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css' rel='stylesheet'/>

        <!-- Custom Theme Style -->
        <link href='build/css/custom.min.css' rel='stylesheet'>


      <body class='nav-md '>
        <div class='container body'>
          <div class='main_container'>
            <div class='col-md-3 left_col'>
              <div class='left_col scroll-view'>
                <div class='navbar nav_title' style='border: 0;'>
                  <img src='public/imgs/logo-blanco-soyservidor-166-57.png' class='img-responsive' width='80%' style='padding-top:10px'/>

                </div>

                <div class='clearfix'></div>

                <!-- menu profile quick info -->
                <div class='profile clearfix'>
                  <div class='profile_pic'>
                    <img src='public/imgs/user.png' alt='...' class='img-circle profile_img'>
                  </div>
                  <div class='profile_info'>
                    <span>Bienvenido,</span>
                    <h2>".$_SESSION["nombre"]." ".
                    $_SESSION["apellido"]."</h2>
                  </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

                <!-- sidebar menu -->
                <div id='sidebar-menu' class='main_menu_side hidden-print main_menu'>
                  <div class='menu_section'>
                    <h3>General</h3>
                    <ul class='nav side-menu'>
                    <li><a><i class='fa fa-building-o'></i> Empresas <span class='fa fa-chevron-down'></span></a>
                      <ul class='nav child_menu'>
                        <li><a href='index.php?page=listadoEmpresa'>Listado de Empresas</a></li>
                        <li><a href='index.php?page=empresa'>Agregar Empresas</a></li>
                      </ul>
                    </li>
                      <li><a><i class='fa fa-file-text-o'></i> Contratos <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='index.php?page=alertaContratos'>Alertas de Contrato</a></li>
                        </ul>
                      </li>
                      <li><a><i class='fa fa-jsfiddle'></i>Servicios <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='index.php?page=servicios'>Listado de los Servicios</a></li>
                          <li><a href='index.php?page=serviciosAgregar&mode=INS'>Agregar Servicios</a></li>
                        </ul>
                      </li>
                      <li><a><i class='fa fa-user'></i> Usuarios <span class='fa fa-chevron-down'></span></a>
                        <ul class='nav child_menu'>
                          <li><a href='index.php?page=usuarios'>Ver Usuarios</a></li>
                          <li><a href='index.php?page=registrate'>Agregar Usuarios</a></li>
                        </ul>
                      </li>
                    </ul>
                  </div>
                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class='sidebar-footer hidden-small'>
                  <a data-toggle='tooltip' data-placement='top' title='Ayuda'
                     href='index.php?page=vistaAyuda' target='_blank'>
                    <span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span>
                  </a>
                  <a data-toggle='tooltip' data-placement='top' title='FullScreen'>
                    <span class='glyphicon glyphicon-fullscreen' aria-hidden='true'></span>
                  </a>
                  <a data-toggle='tooltip' data-placement='top' title='Lock'>
                    <span class='glyphicon glyphicon-eye-close' aria-hidden='true'></span>
                  </a>
                    <a data-toggle='tooltip' data-placement='top' title='Logout' href='index.php?page=CerrarSesion'>
                    <span class='glyphicon glyphicon-off' aria-hidden='true'></span>
                  </a>
                </div>
                <!-- /menu footer buttons -->
              </div>
            </div>

            <!-- top navigation -->
            <div class='top_nav'>
              <div class='nav_menu'>
                <nav>
                  <div class='nav toggle'>
                    <a id='menu_toggle'><i class='fa fa-bars'></i></a>
                  </div>

                  <ul class='nav navbar-nav navbar-right'>
                    <li class=''>
                      <a href='javascript:;' class='user-profile dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                        <img src='public/imgs/user.png' alt=''>".$_SESSION["nombre"]." ".
                        $_SESSION["apellido"]."
                        <span class=' fa fa-angle-down'></span>
                      </a>
                      <ul class='dropdown-menu dropdown-usermenu pull-right'>
                        <li><a href='index.php?page=CerrarSesion'><i class='fa fa-sign-out pull-right'></i> Cerrar Sesión</a></li>
                      </ul>
                    </li>

                    <li role='presentation' class='dropdown'>
                  <a href='javascript:;' class='dropdown-toggle info-number' data-toggle='dropdown' aria-expanded='false'>
                    <i class='fa fa-bell-o'></i>
                    <span class='badge bg-green'>".$cont."</span>
                  </a>
                  <ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>
                    ".$contratosHeader."
                    <li>
                      <div class='text-center'>
                        <a href='index.php?page=alertaContratos'>
                          <strong>Todas las Alertas</strong>
                          <i class='fa fa-angle-right'></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
                      </ul>
                    </li>
                  </ul>
                </nav>
              </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class='right_col' role='main'>
              <div class=''>
                <div class='page-title'>
                ";

    $navbar2="</div>
    </div>
    </div>
            <footer>
              <div class='pull-right'>
                Derechos Reservados 2017
              </div>
              <div class='clearfix'></div>
            </footer>
            <!-- /footer content -->
          </div>
        </div>

        <!-- jQuery -->

        <!-- FastClick -->
        <script src='vendors/fastclick/lib/fastclick.js'></script>
        <!-- NProgress -->
        <script src='vendors/nprogress/nprogress.js'></script>
        <!-- jQuery custom content scroller -->
        <script src='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'></script>

         <script src='vendors/Chart.js/dist/Chart.min.js'></script>

        <!-- Custom Theme Scripts -->
        <script src='build/js/custom.min.js'></script>
      </body>
    ";
  }else {
    $navbar="
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <title>SoyServidor </title>

    <!-- Bootstrap -->
    <link href='vendors/bootstrap/dist/css/bootstrap.min.css' rel='stylesheet'>
    <!-- Font Awesome -->
    <link href='vendors/font-awesome/css/font-awesome.min.css' rel='stylesheet'>
    <!-- NProgress -->
    <link href='vendors/nprogress/nprogress.css' rel='stylesheet'>
    <!-- jQuery custom content scroller -->
    <link href='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css' rel='stylesheet'/>

    <!-- Custom Theme Style -->
    <link href='build/css/custom.min.css' rel='stylesheet'>


  <body class='nav-md '>
    <div class='container body'>
      <div class='main_container'>
        <div class='col-md-3 left_col'>
          <div class='left_col scroll-view'>
            <div class='navbar nav_title' style='border: 0;'>
              <img src='public/imgs/logo-blanco-soyservidor-166-57.png' class='img-responsive' width='80%' style='padding-top:10px'/>
            </div>

            <div class='clearfix'></div>

            <!-- menu profile quick info -->
            <div class='profile clearfix'>
              <div class='profile_pic'>
                <img src='public/imgs/user.png' alt='...' class='img-circle profile_img'>
              </div>
              <div class='profile_info'>
                <span>Bienvenido,</span>
                <h2>".$_SESSION["nombre"]." ".
                    $_SESSION["apellido"]."</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id='sidebar-menu' class='main_menu_side hidden-print main_menu'>
              <div class='menu_section'>
                <h3>General</h3>
                <ul class='nav side-menu'>
                <li><a><i class='fa fa-building-o'></i> Empresas <span class='fa fa-chevron-down'></span></a>
                  <ul class='nav child_menu'>
                    <li><a href='index.php?page=listadoEmpresa'>Listado de Empresas</a></li>
                    <li><a href='index.php?page=empresa'>Agregar Empresas</a></li>
                  </ul>
                </li>
                  <li><a><i class='fa fa-file-text-o'></i> Contratos <span class='fa fa-chevron-down'></span></a>
                    <ul class='nav child_menu'>
                      <li><a href='index.php?page=alertaContratos'>Alertas de Contrato</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class='sidebar-footer hidden-small'>
                <a data-toggle='tooltip' data-placement='top' title='Ayuda'
                   href='index.php?page=vistaAyuda' target='_blank'>
                    <span class='glyphicon glyphicon-question-sign' aria-hidden='true'></span>
                </a>
              <a data-toggle='tooltip' data-placement='top' title='FullScreen'>
                <span class='glyphicon glyphicon-fullscreen' aria-hidden='true'></span>
              </a>
              <a data-toggle='tooltip' data-placement='top' title='Lock'>
                <span class='glyphicon glyphicon-eye-close' aria-hidden='true'></span>
              </a>
              <a data-toggle='tooltip' data-placement='top' title='Logout' href='index.php?page=CerrarSesion'>
                <span class='glyphicon glyphicon-off' aria-hidden='true'></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class='top_nav'>
          <div class='nav_menu'>
            <nav>
              <div class='nav toggle'>
                <a id='menu_toggle'><i class='fa fa-bars'></i></a>
              </div>

              <ul class='nav navbar-nav navbar-right'>
                <li class=''>
                  <a href='javascript:;' class='user-profile dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                    <img src='public/imgs/user.png' alt=''>".$_SESSION["nombre"]." ".
                    $_SESSION["apellido"]."
                    <span class=' fa fa-angle-down'></span>
                  </a>
                  <ul class='dropdown-menu dropdown-usermenu pull-right'>
                   <li><a href='index.php?page=CerrarSesion'><i class='fa fa-sign-out pull-right'></i> Cerrar Sesión</a></li>
                  </ul>
                </li>

                <li role='presentation' class='dropdown'>
              <a href='javascript:;' class='dropdown-toggle info-number' data-toggle='dropdown' aria-expanded='false'>
                <i class='fa fa-bell-o'></i>
                <span class='badge bg-green'>".$cont."</span>
              </a>
              <ul id='menu1' class='dropdown-menu list-unstyled msg_list' role='menu'>
                ".$contratosHeader."
                <li>
                      <div class='text-center'>
                        <a href='index.php?page=alertaContratos'>
                          <strong>See All Alerts</strong>
                          <i class='fa fa-angle-right'></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class='right_col' role='main'>
          <div class=''>
            <div class='page-title'>

            ";

    $navbar2="</div>
    </div>
    </div>
            <footer>
              <div class='pull-right'>
                Derechos Reservados 2017
              </div>
              <div class='clearfix'></div>
            </footer>
            <!-- /footer content -->
          </div>
        </div>

        <!-- jQuery -->

        <!-- FastClick -->
        <script src='vendors/fastclick/lib/fastclick.js'></script>
        <!-- NProgress -->
        <script src='vendors/nprogress/nprogress.js'></script>
        <!-- jQuery custom content scroller -->
        <script src='vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js'></script>

         <script src='vendors/Chart.js/dist/Chart.min.js'></script>

        <!-- Custom Theme Scripts -->
        <script src='build/js/custom.min.js'></script>
      </body>
    ";
  }


}else {
  $navbar="";
  $navbar2="";
}

    addToContext("page_header",$navbar);
    addToContext("page_header2",$navbar2);
    addToContext("page_title","Proyecto Soy Servidor");

}
site_init();
?>
