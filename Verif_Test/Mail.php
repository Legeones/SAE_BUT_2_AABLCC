<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\?????\vendor\autoload.php';      // changer avec l'emplacement du fichier vendor/autoload.php

function SendMail($keys,$email)
{
    $mail = new PHPMailer(TRUE);
    
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->Host = "smtp.uphf.fr";       // dependant du smtp serveur utilisé
    $mail->SMTPAuth = true;
    $mail->AuthType = 'LOGIN';
    $mail->Username = "???";      // dependant de l'utilisateur (envoie)
    $mail->Password = "???";   // dependant de l'utilisateur (envoie)
    $mail->SMTPSecure = "ssl";          // dependant du smtp serveur utilisé
    $mail->Port = 465;                  // dependant du smtp serveur utilisé
    
    $mail->SetFrom ('???@uphf.fr','EC');  // dependant de l'utilisateur (envoie)
    $mail->AddAddress ($email, 'EC2');
    
    $mail->CharSet = 'windows-1250';
    $mail->ContentType = 'text/plain';
    
    $mail->IsHTML(false);
    $mail->Subject = "Test Code de Verification";
    $mail->Body = "Votre code de verification est " . $keys;
    
    if(!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Successfully sent!";
    }
}

function SendRequestMail($email,$body)
{
    $mail = new PHPMailer(TRUE);
    
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->Host = "smtp.uphf.fr";       // dependant du smtp serveur utilisé
    $mail->SMTPAuth = true;
    $mail->AuthType = 'LOGIN';
    $mail->Username = "???";      // dependant de l'utilisateur (envoie)
    $mail->Password = "???";   // dependant de l'utilisateur (envoie)
    $mail->SMTPSecure = "ssl";          // dependant du smtp serveur utilisé
    $mail->Port = 465;                  // dependant du smtp serveur utilisé
    
    $mail->SetFrom ('???@uphf.fr','Assistance');  // dependant de l'utilisateur (envoie)
    $mail->AddAddress ('???@uphf.fr', 'Assistance');
    
    $mail->CharSet = 'windows-1250';
    $mail->ContentType = 'text/plain';
    
    $mail->IsHTML(false);
    $mail->Subject = "Requete d'assistance de : $email";
    $mail->Body = $body;
    
    if(!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Successfully sent!";
    }
    
    function MailPreparator($indexkey,$email)
{
    session_start();
    $_SESSION['Code'] = rand(100000,999999);
    $_SESSION['Key_Index'] = $indexkey;
    
    SendMail($_SESSION['Code'],$email);
    
    header('Location: ../Verif_Test/MailCode_Formulaire.php?');
}
?>
