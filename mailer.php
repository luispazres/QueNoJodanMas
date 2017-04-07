<?php
require_once("clases/PHPMailerAutoload.php");
require_once("clases/class.phpmailer.php");
require_once("clases/class.phpmaileroauth.php");
require_once("clases/class.smtp.php");
require_once("clases/class.pop3.php");
require_once("clases/class.phpmaileroauthgoogle.php");

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
                                    Alerta de vencimiento\n\n El contrato #53 tiene 7 dias de vigencia antes de su vencimiento
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
 //$mail->SMTPDebug = 4;
 //$mail->SMTPDebug=2;
 $mail->Host = 'smtp.gmail.com';
 $mail->SMTPAuth = true;
 $mail->Username = 'desarrollojr@soyservidor.com';
 $mail->Password = 'soyservidor2017';                         // SMTP password
 $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 465 ;                                    // TCP port to connect to

 $mail->setFrom('desarrollojr@soyservidor.com', 'Mailer');
 $mail->addAddress('michi.navarro1994@gmail.com', 'Michelle');         // Add a recipient
 //$mail->addAddress('ellen@example.com');               // Name is optional
 $mail->addReplyTo('desarrollojr@soyservidor.com', 'Information');
 //$mail->addCC('cc@example.com');
 //$mail->addBCC('bcc@example.com');

 //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
 $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
 $mail->isHTML(true);                                  // Set email format to HTML

 $mail->Subject = 'Alerta de vencimiento';
 $mail->Body    = $mensaje;
 $mail->AltBody = 'El contrato #58 de la empresa Ecobanking con servicio Redes Sociales esta a 7 dias de expirar.';

 if(!$mail->send()) {
     echo 'Message could not be sent.';
     echo 'Mailer Error: ' . $mail->ErrorInfo;
 } else {
     echo 'Message has been sent';
 }

 ?>
