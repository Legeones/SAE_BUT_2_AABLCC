<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

/*
ini_set('SMTP','smtp.uphf.fr');
ini_set('sendmail_from','Erwan.Chaste1@uphf.fr');
ini_set('username','Erwan.Chaste1@uphf.fr');
ini_set('password','xxx');
ini_set("smtp_port", "465");
*/

use PHPMailer\PHPMailer\PHPMailer;

require ("PHPMailer-master/src/PHPMailer.php");
require ("PHPMailer-master/src/SMTP.php");
require ("PHPMailer-master/src/Exception.php");

function Verifier_Email_B($email)
{
$mail = new PHPMailer();

$mail->IsSMTP();                       // telling the class to use SMTP

$mail->SMTPDebug = 0;
// 0 = no output, 1 = errors and messages, 2 = messages only.

$mail->SMTPAuth = true;                // enable SMTP authentication
$mail->SMTPSecure = "ssl";              // sets the prefix to the servier
$mail->Host = "smtp.uphf.fr";        // sets Gmail as the SMTP server
$mail->Port = 25;                     // set the SMTP port for the GMAIL

$mail->Username = "info@example.com";  // Gmail username
$mail->Password = "yourpassword";      // Gmail password

$mail->CharSet = 'windows-1250';
$mail->SetFrom ('Erwan.Chaste1@uphf.fr');
$mail->AddBCC ( 'sales@example.com', 'Example.com Sales Dep.');
$mail->Subject = "essay";
$mail->ContentType = 'text/plain';
$mail->IsHTML(false);

$mail->Body = "test";
// you may also use $mail->Body = file_get_contents('your_mail_template.html');

$mail->AddAddress ($email, 'Recipients Name');
// you may also use this format $mail->AddAddress ($recipient);

if(!$mail->Send())
{
    echo "Mailer Error: " . $mail->ErrorInfo;
} else
{
    echo "Successfully sent!";
}
}

// You may delete or alter these last lines reporting error messages, but beware, that if you delete the $mail->Send() part, the e-mail will not be sent, because that is the part of this code, that actually sends the e-mail. 

function VerifEmail_Validity($email)
{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    { return 1; }
    else
    { return 0; }
}

function Verifier_Email_A($email)
{
    echo "Begining Email Validity Verfication <br> <br>";
    
    $email_Validation = VerifEmail_Validity($email);
    
    if ( $email_Validation = 1 )    { echo "Adresse Email Nettoyer et valider <br> <br>";    Send_Mail($email); }
    else                            { echo "Adresse Email Invalide ou mal structurer <br> <br>"; }
}

function Send_Mail($email)
{
    $to = $email;
    $subject = "Testiing_Unity";
    $message = "Ceci est un test";
    $additional_headers = array();
    
    if(mail($to,$subject,$message,$additional_headers))
    {
        echo 'Email on the way';
    }
}

Verifier_Email_B($_POST["Mail"]);

?>
