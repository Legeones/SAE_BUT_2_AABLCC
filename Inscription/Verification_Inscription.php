<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../Verif_Test/Mail_Test.php');
require('../Verif_Test/Verifiant.php');

$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["Password_A"]);
$resVerifPassword_Number=VerifPassword_Number($_POST["Password_A"]);
$resVerifPassword_Equality=VerifPassword_Equality($_POST["Password_A"], $_POST["Password_B"]);
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["Password_A"]);
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["Password_A"]);
$VerifEmptyContent1=VerifEmptyContent($_POST["email"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["ID"]);
$VerifEmail=VerifEmail($_POST["email"]);

session_start();
$_SESSION['EMAIL'] = $_POST['email'];
$_SESSION['IDENTIFIANT'] = $_POST['ID'];
$_SESSION['ROLE'] = 'etu';
$_SESSION['PASSWORD'] = $_POST["Password_A"];

if ($resVerifPassword_Equality==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=2');
}

elseif ($resVerifPassword_Lenght==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=1');
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=3');
}

elseif($resVerifPassword_Number==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=4');
}

elseif($resVerifPassword_Uppercase==0) {
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=5');
}

elseif ($VerifEmptyContent1==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=6');
}

elseif ($VerifEmptyContent2==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=6');
}

elseif ($VerifEmail==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=7');
}

else
{
    session_start();
    $_SESSION['Code'] = rand(100000,999999);
    $_SESSION['Key_Index'] = 1;
    
    SendMail($_SESSION['Code'],$_POST['email']);
    
    header('Location: ../Verif_Test/MailCode_Formulaire.php?');
}

?>
