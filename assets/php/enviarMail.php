<?php 

$destinatario = 'asaerca@gmail.com';

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$asunto = 'Formulario Rellenado desde asaerca.com.ar';
$mensaje = $_POST['mensaje'];

$mensajeCompleto = "Mensaje: " . $mensaje . "\n\n Mail: " . $email . "\n\n Atentamente: " . $nombre;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

	//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$mail->SMTPDebug = 0;
$mail->isSMTP();                                            //Send using SMTP
$mail->Host       = 'smtp.correoseguro.co';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'asaerca@asaerca.com.ar';                     //SMTP username
$mail->Password   = '2APqKxCzLnG8';                               //SMTP password
$mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
$mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
$mail->Sender='asaerca@asaerca.com.ar';
$mail->SetFrom( $email, $nombre, FALSE);
// $mail->setFrom( 'asaerca@asaerca.com.ar', 'Asaerca');
$mail->addAddress($destinatario);               //Name is optional

    //Content
$mail->Subject = $asunto;
$mail->Body    = $mensajeCompleto;

if( $mail->send() ){
	echo "<script>alert('correo enviado exitosamente')</script>";
	echo "<script> setTimeout(\"location.href ='https://asaerca.com.ar/'\",1000) </script>";
} else {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}

$mail->smtpClose();


