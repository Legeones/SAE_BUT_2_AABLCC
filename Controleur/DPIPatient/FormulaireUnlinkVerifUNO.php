<?php
session_start();
$_SESSION['IPPImageSupp']=$_POST['IPPImageSupp'];
$_SESSION['catSUPP']=$_POST['catSUPP'];

require("../Verifiant/Verifiant.php");
require ('../../Model/BDD/DataBase_Dpi.php');


$VerifEmptyContent=VerifEmptyContent($_POST["IPPImageSupp"]);
$VerifPatient=Check_Patient($_POST['IPPImageSupp']);

if($VerifEmptyContent==0){
    header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php?erreur=6'); // Zone de gestion des erreurs
}

else if($VerifPatient==0){
    header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php.php?erreur=7'); // Zone de gestion des erreurs
}

else{
    header('Location: ../../Vue/DPIPatient/FormulaireUnlinkTWO.php');
}