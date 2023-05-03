<?php

require ('../Verifiant/Verifiant.php');
require ('../../Model/BDD/DataBase_Dpi.php');

session_start();

$VerifEmptyContent=VerifEmptyContent($_SESSION["IPP_SUPP"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_SESSION["IPP_SUPP"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_SESSION["IPP_SUPP"]);


if($VerifEmptyContent==0)
{ header('Location: ../../Vue/DPIPatient/SupprimerPatient.php?erreur=1'); } // Zone de gestion des erreurs

elseif ($VerifPassword_Uppercase==1 || $VerifPassword_Lowercase==1)
{ header('Location: ../../Vue/DPIPatient/SupprimerPatient.php?erreur=3'); } // Zone de gestion des erreurs


else { DataBase_Delete_Patient(); }
