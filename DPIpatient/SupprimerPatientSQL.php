<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_Dpi.php');

session_start();

$VerifEmptyContent=VerifEmptyContent($_SESSION["IPP_SUPP"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_SESSION["IPP_SUPP"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_SESSION["IPP_SUPP"]);


if($VerifEmptyContent==0)
{ header('Location: ../DPIpatient/SupprimerPatient.php?erreur=1'); }

elseif ($VerifPassword_Uppercase==1 or $VerifPassword_Lowercase==1)
{ header('Location: ../DPIpatient/SupprimerPatient.php?erreur=3'); }


else { DataBase_Delete_Patient(); }
