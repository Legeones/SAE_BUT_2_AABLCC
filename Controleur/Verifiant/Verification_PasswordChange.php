<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require ('../Accueil/Mail.php');
require ('../Verifiant/Verifiant.php');


$resVerifemptymail = VerifEmptyContent($_POST['mail']);
$resVerifemptyusername = VerifEmptyContent($_POST['username']);
$resVerifMail = VerifEmail($_POST['mail']);

session_start();
$_SESSION['IDENTIFIANT'] = $_POST['username'];
$_SESSION['EMAIL'] = $_POST['mail'];

if ( $resVerifMail == 0 )
{ header('Location: ../../Vue/MDP/MDPoublier.php?erreur=1'); } // Zone de vérification

if ( $resVerifemptymail == 0 )
{ header('Location: ../../Vue/MDP/MDPoublier.php?erreur=2'); } // Zone de vérification

if ( $resVerifemptyusername == 0 )
{ header('Location: ../../Vue/MDP/MDPoublier.php?erreur=2'); } // Zone de vérification

else 
{ MailPreparator(2,$_POST['mail']); }
?>
