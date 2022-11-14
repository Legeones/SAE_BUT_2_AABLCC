<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_User.php');

$VerifEmptyContent1=VerifEmptyContent($_POST["ID"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["Role"]);

if ($VerifEmptyContent1==0)
{ header('Location: ../DPIpatient/AttributionRole.php?erreur=2'); }

elseif ($VerifEmptyContent2==0)
{ header('Location: ../DPIpatient/AttributionRole.php?erreur=2'); }

else { DataBase_Attribute_Role($_POST["ID"],$_POST["Role"]); }
?>
