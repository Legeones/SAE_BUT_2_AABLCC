<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../BDD/DataBase_User.php');
require('../Verif_Test/Verifiant.php');

$resVerifPassword_Equality=VerifPassword_Equality($_POST["MDP"], $_POST["Re_MDP"]);
$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["MDP"]);
$resVerifPassword_Number=VerifPassword_Number($_POST["MDP"]);
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["MDP"]);
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["MDP"]);

if ($resVerifPassword_Equality==0){
    header('Location: ../MDP/change_mdp.php?erreur=2');
}

elseif ($resVerifPassword_Lenght==0){
    header('Location: ../MDP/change_mdp.php?erreur=1');
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: ../MDP/change_mdp.php?erreur=3');
}

elseif($resVerifPassword_Number==0){
    header('Location: ../MDP/change_mdp.php?erreur=4');
}

elseif($resVerifPassword_Uppercase==0){
    header('Location: ../MDP/change_mdp.php?erreur=5');
}

else
{
    DataBase_User_New_Pass_Modify($_POST['username'],$_POST['MDP']);
}
?>
