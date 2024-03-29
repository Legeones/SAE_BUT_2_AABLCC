<?php

require ("../Verifiant/Verifiant.php");
require ("../../Model/BDD/DataBase_Dpi.php");


session_start();

$VerifEmptyContent2=VerifEmptyContent($_POST["nomImageSupp"]);


if($VerifEmptyContent2==0){
    header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php?erreur=6');
}

else{
    $fichier = "../../Images/".$_SESSION['catSUPP']."/".$_POST['nomImageSupp'];
    if (file_exists($fichier)){
        echo "hello";
        if($_SESSION['catSUPP']=='Biologie'){
            $VeriCheckImage=Check_Image_Biologie($_SESSION["IPPImageSupp"],$fichier);
            if($VeriCheckImage==0){
                header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php?erreur=1');
            }else{
                unlink($fichier);
                Delete_Image_Biologie($fichier);
                header('Location: ../../Vue/DPIPatient/DPI.php');
            }
        }
        elseif ($_SESSION['catSUPP']=='Courriel'){
            $VeriCheckImage=Check_Image_Courriel($_SESSION["IPPImageSupp"],$fichier);
            if($VeriCheckImage==0){
                header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php?erreur=1');
            }else{
                echo 'parfait';
                unlink($fichier);
                Delete_Image_Courriel($fichier);
                header('Location: ../../Vue/DPIPatient/DPI.php');
            }
        }
        elseif ($_SESSION['catSUPP']=='Imagerie'){
            $VeriCheckImage=Check_Image_Imagerie($_SESSION["IPPImageSupp"],$fichier);
            if($VeriCheckImage==0){
                header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php?erreur=1');
            }else{
                echo 'parfait';
                unlink($fichier);
                Delete_Image_Imagerie($fichier);
                header('Location: ../../Vue/DPIPatient/DPI.php');
            }
            }
        }
    else{
        header('Location: ../../Vue/DPIPatient/FormulaireUnlink.php?erreur=5');
    }
}
