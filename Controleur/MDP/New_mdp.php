<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require ('../../Model/BDD/DataBase_User.php');
require ('../Verifiant/Verifiant.php');

$resVerifPassword_Equality=VerifPassword_Equality($_POST["MDP"], $_POST["Re_MDP"]);
$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["MDP"]);
$resVerifPassword_Number=VerifPassword_Number($_POST["MDP"]);
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["MDP"]);
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["MDP"]);


if ($resVerifPassword_Equality==0){
    header('Location: ../../Vue/MDP/change_mdp.php?erreur=2'); // Erreur le mot de passe et sa confirmation sont différents
}

elseif ($resVerifPassword_Lenght==0){
    header('Location: ../../Vue/MDP/change_mdp.php?erreur=1'); // Erreur le mot de passe à moins de 8 caractères
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: ../../Vue/MDP/change_mdp.php?erreur=3'); // Erreur pas de minuscule
}

elseif($resVerifPassword_Number==0){
    header('Location: ../../Vue/MDP/change_mdp.php?erreur=4'); // Erreur pas de numéro
}

elseif($resVerifPassword_Uppercase==0){
    header('Location: ../../Vue/MDP/change_mdp.php?erreur=5'); // Erreur pas de majuscule
}

else
{
    DataBase_User_New_Pass_Modify($_POST['username'],$_POST['MDP']);
}
?>
