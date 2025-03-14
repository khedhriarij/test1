<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';
// instancier la classe mailer

$mail = new PHPMailer(true);

$mail->isSMTP(); //Specifier que PHPMailer utilise le protocole SMTP.(simple mail transfer protocol)
$mail->Host = 'smtp.gmail.com'; // Specifier le serveur gmail
$mail->SMTPAuth = true; //Pour activer l'authentifiaction
$mail->Username = 'compteweb2004@gmail.com';
$mail->Password = 'ariv cpts zxng ggtm';
$mail->SMTPSecure = 'tls'; //type de cryptage
$mail->Port = 587;
$mail->CharSet = "utf-8"; //type de codage
$mail->setFrom('khedhriarij31@gmail.com', 'club_essect');
$mail->addAddress($_POST['email'], 'club_essect');
$mail->isHTML(true); // Pour activer l'envoi de mail sous forme html

$mail->Subject = 'Confirmation d\'email';
$mail->Body = 'Afin de valider votre adresse email, merci de cliquer sur le lien suivant :
<a href="http://localhost/version2/helpers/PHPMailer/verification.php?token='.$token.'&email='.$_POST['email'].'">confirmation email</a>';



$mail->SMTPDebug = 0; //Pour désactiver le debug

if(!$mail->send()){
    $message = "Mail non envoyé";
    echo 'Erreurs: ' . $mail->ErrorInfo;
}else{
    $message = "Un mail vient detre envoye pour confirmation de votre compte !";
   
}