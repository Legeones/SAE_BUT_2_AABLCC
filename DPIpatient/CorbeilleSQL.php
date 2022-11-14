<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_Dpi.php');

session_start();
$_SESSION["IPP_CORB"]=$_POST["IPP_CORB"];

$VerifEmptyContent=VerifEmptyContent($_SESSION["IPP_CORB"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_SESSION["IPP_CORB"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_SESSION["IPP_CORB"]);


if($VerifEmptyContent==0)
{ header('Location: ../DPIpatient/Corbeille.php?erreur=1'); }

elseif ($VerifPassword_Uppercase==1 or $VerifPassword_Lowercase==1)
{ header('Location: ../DPIpatient/Corbeille.php?erreur=3'); }


else { DataBase_Corbeille_Patient(); }