<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

ini_set('SMTP','smtp.gmail.com');
ini_set('sendmail_from','dpimailcenter@gmail.com');

ini_set("SMTP", "ssl://smtp.gmail.com");
ini_set("smtp_port", "465");

function VerifEmail_Validity($email)
{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    { return 1; }
    else
    { return 0; }
}

function Verifier_Email($email)
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

Verifier_Email($_POST["Mail"]);

?>