<?php
require ('../Verifiant/Verifiant.php');
require ('../../Model/BDD/DataBase_User.php');

$VerifEmptyContent1=VerifEmptyContent($_POST["ID"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["Role"]);


if ($VerifEmptyContent1==0)
{ header('Location: ../../Vue/Accueil/AttributionRole.php?erreur=2'); } // Zone de gestion des erreurs

elseif ($VerifEmptyContent2==0)
{ header('Location: ../../Vue/Accueil/AttributionRole.php?erreur=2'); } // Zone de gestion des erreurs

else { DataBase_Attribute_Role($_POST["ID"],$_POST["Role"]); }
?>
