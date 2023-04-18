<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '...\vendor\autoload.php';      // corespond a l'emplacement du fichier vendor/autoload.php

function SendMail($keys,$email)
{
    $mail = new PHPMailer(TRUE);
    
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->Host = "smtp.uphf.fr";       // serveur SMTP utilisé
    $mail->SMTPAuth = true;             // authentification active/inactive
    $mail->AuthType = 'LOGIN';          // type d'authentification
    $mail->Username = "XXX";            // identifiant (login)
    $mail->Password = "XXX";            // mot de passe
    $mail->SMTPSecure = "ssl";          // dependant du smtp serveur utilisÃ©
    $mail->Port = 465;                  // dependant du smtp serveur utilisÃ©
    
    $mail->SetFrom (GetMail(),'EC');    // prend l'adresse d'envoie + un nom d'identification
    $mail->AddAddress ($email, 'EC2');  // définit l'adresse d'envoie
    
    $mail->CharSet = 'windows-1250';    // définit la type d'écrit
    $mail->ContentType = 'text/plain';  // 
    
    $mail->IsHTML(false);
    $mail->Subject = "Test Code de Verification"; // Permet la vérification du code
    $mail->Body = "Votre code de verification est " . $keys;    // keys fait référence au code de vérification
    
    if(!$mail->Send())
        
    {
        echo "Mailer Error: " . $mail->ErrorInfo; // Erreur dans l'envoie du mail
    }
    else
    {
        echo "Successfully sent!"; // Mail envoyé avec succèes
    }
}

function SendRequestMail($email,$body)
{
    $mail = new PHPMailer(TRUE);
    
    $mail->SMTPDebug = 1;
    $mail->IsSMTP();
    $mail->Host = "smtp.uphf.fr";       // serveur SMTP utilisé
    $mail->SMTPAuth = true;             // authentification active/inactive
    $mail->AuthType = 'LOGIN';          // type d'authentification
    $mail->Username = "XXX";            // identifiant (login)
    $mail->Password = "XXX";            // mot de passe
    $mail->SMTPSecure = "ssl";          // dependant du smtp serveur utilisÃ©
    $mail->Port = 465;                  // dependant du smtp serveur utilisÃ©
    
    $mail->SetFrom (GetMail(),'Assistance');        // prend l'adresse d'envoie + un nom d'identification
    $mail->AddAddress (GetMail(), 'Assistance');    // dans ce cas, le mail est renvoyé vers lui même
    
    $mail->CharSet = 'windows-1250';     // définit la type d'écrit
    $mail->ContentType = 'text/plain';   //
    
    $mail->IsHTML(false);
    $mail->Subject = "Requete d'assistance de : $email";
    $mail->Body = $body;        // contient le message de la part de l'utilisateur
    
    if(!$mail->Send())
    {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
        echo "Successfully sent!";
    }
}
    
function MailPreparator($indexkey,$email)
{
    session_start();
    $_SESSION['Code'] = rand(100000,999999);    // génère un code aléatoire a 6 chiffre
    $_SESSION['Key_Index'] = $indexkey;         // insère le code dans la session en cours, cela permettra la verification coté utilisateur
    $_SESSION['CodeTimer'] = time();
    
    SendMail($_SESSION['Code'],$email);         // envoie le mail avec le code généré
    
    header('Location: ../Verif_Test/MailCode_Formulaire.php?');
}

function GetMail()
{
    return 'XXX@uphf.fr';     // adresse mail servant a l'envoie
}

function Resend()   // option permettant la reconduite d'un mail, si non envoyé
{
    session_start();
    MailPreparator($_SESSION['Key_Index'],$_SESSION['EMAIL']);
}
?>
