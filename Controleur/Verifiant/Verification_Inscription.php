<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../Accueil/Mail.php');
require ('../Verifiant/Verifiant.php');

$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["Password_A"]); // Vérification du Password_A
$resVerifPassword_Number=VerifPassword_Number($_POST["Password_A"]); // Vérification du Password_B
$resVerifPassword_Equality=VerifPassword_Equality($_POST["Password_A"], $_POST["Password_B"]); // Vérification si le Password_A = Password_B
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["Password_A"]); // Vérification de la longueur du Password_A
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["Password_A"]); // Vérification Password_A
$VerifEmptyContent1=VerifEmptyContent($_POST["email"]); // Vérification de l'email
$VerifEmptyContent2=VerifEmptyContent($_POST["ID"]); // Vérification de l'ID
$VerifEmptyContent3=VerifEmptyContent($_POST["nom"]); // Vérification du nom
$VerifEmptyContent4=VerifEmptyContent($_POST["prenom"]); // Vérification du prenom
$VerifEmail=VerifEmail($_POST["email"]); // Vérification de l'email

session_start();
$_SESSION['EMAIL'] = $_POST['email'];
$_SESSION['IDENTIFIANT'] = $_POST['ID'];
$_SESSION['ID_NOM'] = $_POST['nom'];
$_SESSION['ID_PRENOM'] = $_POST['prenom'];
$_SESSION['ROLE'] = 'etudiant';
$_SESSION['PASSWORD'] = $_POST["Password_A"];

// Erreur page inscription
if ($resVerifPassword_Equality==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=2'); // erreur le mot de passe et sa confirmation sont diffÃ©rents
}
elseif ($resVerifPassword_Lenght==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=1'); // erreur le mot de passe à moins de 8 caractéres
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=3'); // Erreur minuscule
}

elseif($resVerifPassword_Number==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=4'); // Erreur numéro
}

elseif($resVerifPassword_Uppercase==0) {
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=5'); // Erreur majuscule
}

elseif ($VerifEmptyContent1==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=6'); // Erreur login invalide
}

elseif ($VerifEmptyContent2==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=6'); // Erreur login invalide
}

elseif ($VerifEmptyContent3==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=7'); // Erreur Nom vide
}

elseif ($VerifEmptyContent4==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=7'); // Erreur Prenom Vide
}

elseif ($VerifEmail==0){
    header('Location: ../../Vue/Inscription/Inscription_formulaire.php?erreur=7');
}

else
{ MailPreparator(1,$_POST['email']); }

?>
