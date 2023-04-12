<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_Dpi.php');

$VerifEmptyContent1=VerifEmptyContent($_POST["IPP"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["nom"]);
$VerifEmptyContent3=VerifEmptyContent($_POST["date"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_POST["IPP"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_POST["IPP"]);

if($VerifEmptyContent1==0 || $VerifEmptyContent2==0 || $VerifEmptyContent3==0)
{ header('Location: ../DPIpatient/ajouterPatient.php?erreur=1'); }

elseif ($VerifPassword_Uppercase==1 || $VerifPassword_Lowercase==1)
{ header('Location: ../DPIpatient/ajouterPatient.php?erreur=3'); }

else { Database_Add_Patient($_POST['IPP'],$_POST['nom'],$_POST['date']); }
