<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../Verif_Test/Mail.php');
require('../Verif_Test/Verifiant.php');

$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["Password_A"]); // VÃ©rification du Password_A
$resVerifPassword_Number=VerifPassword_Number($_POST["Password_A"]); // VÃ©rification du Password_B
$resVerifPassword_Equality=VerifPassword_Equality($_POST["Password_A"], $_POST["Password_B"]); // VÃ©rification si le Password_A = Password_B
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["Password_A"]); // VÃ©rification de la longueur du Password_A
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["Password_A"]); // VÃ©rification Password_A
$VerifEmptyContent1=VerifEmptyContent($_POST["email"]); // VÃ©rification de l'email
$VerifEmptyContent2=VerifEmptyContent($_POST["ID"]); // VÃ©rification de l'ID
$VerifEmptyContent3=VerifEmptyContent($_POST["nom"]); // VÃ©rification du nom
$VerifEmptyContent4=VerifEmptyContent($_POST["prenom"]); // VÃ©rification du prenom
$VerifEmail=VerifEmail($_POST["email"]); // VÃ©rification de l'email

session_start();
$_SESSION['EMAIL'] = $_POST['email'];
$_SESSION['IDENTIFIANT'] = $_POST['ID'];
$_SESSION['ROLE'] = 'etudiant';
$_SESSION['PASSWORD'] = $_POST["Password_A"];

// Erreur page inscription
if ($resVerifPassword_Equality==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=2'); // erreur le mot de passe et sa confirmation sont diffÃ©rents
}
elseif ($resVerifPassword_Lenght==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=1'); // erreur le mot de passe Ã  moins de 8 caractÃ¨res
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=3'); // Erreur minuscule
}

elseif($resVerifPassword_Number==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=4'); // Erreur numÃ©ro
}

elseif($resVerifPassword_Uppercase==0) {
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=5'); // Erreur majuscule
}

elseif ($VerifEmptyContent1==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=6'); // Erreur login invalide
}

elseif ($VerifEmptyContent2==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=6'); // Erreur login invalide
}

elseif ($VerifEmptyContent3==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=7'); // Erreur Nom vide
}

elseif ($VerifEmptyContent4==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=7'); // Erreur Prenom Vide
}

elseif ($VerifEmail==0){
    header('Location: ../Inscription/Inscription_formulaire.php?erreur=7');
}

else
{ MailPreparator(1,$_POST['email']); }

?>
