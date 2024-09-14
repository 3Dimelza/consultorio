<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/*require 'vendor/autoload.php';*/


require 'vendor/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/src/Exception.php';


$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'duran.dimelza.647@gmail.com';
    $mail->Password = 'iuue llkm fwhd cevl';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('duran.dimelza.647@gmail.com', 'Dimelza');
    $mail->addAddress('dimelherondale@gmail.com', 'DimelzaH');
    $mail->addCC('concopia@gmail.com');

    $mail->addAttachment('docs/dashboard.png', 'Dashboard.png');

    $mail->isHTML(true);
    $mail->Subject = 'Prueba desde GMAIL';
    $mail->Body = 'Hola, <br/>Esta es una prueba desde <b>Gmail</b>.';
    $mail->send();

    echo 'Correo enviado';
} catch (Exception $e) {
    echo 'Mensaje ' . $mail->ErrorInfo;
}  

/*
try {
            // Configuración del servidor de correo
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'duran.dimelza.647@gmail.com';
            $mail->Password = 'iuue llkm fwhd cevl';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Configuración del correo
           
            $mail->setFrom('duran.dimelza.647@gmail.com', 'Dimelza');
            $mail->addAddress('dimelherondale@gmail.com', 'DimelzaH');
            $mail->addCC('concopia@gmail.com');
        
            $mail->addAttachment('docs/dashboard.png', 'Dashboard.png');

            $mail->isHTML(true);
            $mail->Subject = 'Verificación de correo electrónico';
            $mail->Body = 'Por favor, haga clic en el siguiente enlace para verificar su correo electrónico: 
                        <a href="' . base_url() . 'verificar?token=' . $token . '">Verificar Correo</a>';

            // Enviar el correo
            $mail->send();
        } catch (Exception $e) {
            log_message('error', 'Error al enviar correo de verificación: ' . $mail->ErrorInfo);
        }
*/
