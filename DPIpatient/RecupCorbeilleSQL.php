<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_Dpi.php');



$VerifEmptyContent=VerifEmptyContent($_POST["IPP_Recup"]);
$VerifPassword_Uppercase=VerifPassword_Uppercase($_POST["IPP_Recup"]);
$VerifPassword_Lowercase=VerifPassword_Lowercase($_POST["IPP_Recup"]);


if($VerifEmptyContent==0)
{ header('Location: ../DPIpatient/RecupCorbeille.php?erreur=1'); } // Zone de vérification

elseif ($VerifPassword_Uppercase==1 || $VerifPassword_Lowercase==1)
{ header('Location: ../DPIpatient/RecupCorbeille.php?erreur=3'); } // Zone de vérification


else { DataBase_Delete_Corbeille($_POST["IPP_Recup"]); }
