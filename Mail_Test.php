<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\erwan\vendor\autoload.php';      // changer avec l'emplacement du fichier vendor/autoload.php

function SendMail($email)
{
    $mail = new PHPMailer(TRUE);
    
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->Host = "smtp.uphf.fr";       // dependant du smtp serveur utilisé
    $mail->SMTPAuth = true;
    $mail->AuthType = 'LOGIN';
    $mail->Username = "Login";       // dependant de l'utilisateur (envoie)
    $mail->Password = "Mot_de_Passe";   // dependant de l'utilisateur (envoie)
    $mail->SMTPSecure = "ssl";          // dependant du smtp serveur utilisé
    $mail->Port = 465;                  // dependant du smtp serveur utilisé
    
    $mail->SetFrom ('Mail@uphf.fr','EC');  // dependant de l'utilisateur (envoie)
    $mail->AddAddress ($email, 'EC2');
    
    $mail->CharSet = 'windows-1250';
    $mail->ContentType = 'text/plain';
    
    $mail->IsHTML(false);
    $mail->Subject = "essay";
    $mail->Body = "test";
    
    if(!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Successfully sent!";
    }
}

// You may delete or alter these last lines reporting error messages, but beware, that if you delete the $mail->Send() part, the e-mail will not be sent, because that is the part of this code, that actually sends the e-mail. 

function VerifEmail_Validity($email)
{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    { return 1;     SendMail($email); }
    else
    { return 0; }
}

VerifEmail_Validity($email);

?>
