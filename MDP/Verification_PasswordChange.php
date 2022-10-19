<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../Verif_Test/Mail_Test.php');

function VerifEmail($email)
{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    { return 1; }
    else
    { return 0; }
}

function VerifEmptyContent($text)
{
    if ($text == "")
    { return 0; }
    else
    { return 1; }
}

$resVerifemptymail = VerifEmptyContent($_POST['mail']);
$resVerifemptyusername = VerifEmptyContent($_POST['username']);
$resVerifMail = VerifEmail($_POST['mail']);

session_start();
$_SESSION['IDENTIFIANT'] = $_POST['username'];

if ( $resVerifMail == 0 )
{ header('Location: ../MDP/MDPoublier.php?erreur=1'); }

if ( $resVerifemptymail == 0 )
{ header('Location: ../MDP/MDPoublier.php?erreur=2'); }

if ( $resVerifemptyusername == 0 )
{ header('Location: ../MDP/MDPoublier.php?erreur=2'); }

else 
{
    session_start();
    $_SESSION['Code'] = rand(100000,999999);
    $_SESSION['Key_Index'] = 2;
    
    SendMail($_SESSION['Code'],$_POST['mail']);
    
    header('Location: ../Verif_Test/MailCode_Formulaire.php?');
}


?>
