<?php 

$destinatario = 'ventas@compasso.com.ar';

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$company = $_POST['company'] ?? '';
$asunto = 'Formulario Rellenado desde compasso.com.ar';
$message = $_POST['message'] ?? '';

if (empty($name)) {
    echo "<script>alert('El nombre es obligatorio. Por favor, inténtalo de nuevo.');location.href ='https://compasso.com.ar/contacto.html';</script>";
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('El correo electrónico es inválido. Por favor, inténtalo de nuevo.');location.href ='https://compasso.com.ar/contacto.html';</script>";
    exit;
}

if (empty($message)) {
    echo "<script>alert('El mensaje es obligatorio. Por favor, inténtalo de nuevo.');location.href ='https://compasso.com.ar/contacto.html';</script>";
    exit;
}

$mensajeCompleto = "Mensaje: " . $message . "\n\n Mail: " . $email . "\n\n Telefono: " . $phone . "\n\n Compañia: " . $company . "\n\n Atentamente: " . $name;
/*
echo '<script>console.log("' . $mensajeCompleto . '")</script>';
echo '<script>console.log("' . $name . '")</script>';
echo '<script>console.log("' . $email . '")</script>';
echo '<script>console.log("' . $phone . '")</script>';
echo '<script>console.log("' . $company . '")</script>';
echo '<script>console.log("' . $asunto . '")</script>';
echo '<script>console.log("' . $message . '")</script>';
*/

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
$mail->Host       = 'c2061788.ferozo.com';                     //Set the SMTP server to send through
$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
$mail->Username   = 'ventas@compasso.com.ar';                     //SMTP username
$mail->Password   = 'Al411547';                               //SMTP password
$mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
$mail->Sender='ventas@compasso.com.ar';
$mail->SetFrom( $email, $nombre, FALSE);
// $mail->setFrom( 'asaerca@asaerca.com.ar', 'Asaerca');
$mail->addAddress($destinatario);               //Name is optional

    //Content
$mail->Subject = $asunto;
$mail->Body    = $mensajeCompleto;

if( $mail->send() ){
	echo "<script>alert('correo enviado exitosamente')</script>";
	echo "<script> setTimeout(\"location.href ='https://compasso.com.ar/'\",1000) </script>";
} else {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}

$mail->smtpClose();

?>