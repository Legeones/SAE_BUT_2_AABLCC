<?php
require ("../Verif_Test/Verifiant.php");
require('../BDD/DataBase_Dpi.php');



$VerifEmptyContent=VerifEmptyContent($_POST["IPPImageSupp"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["nomImageSupp"]);
$VerifPatient=Check_Patient($_POST['IPPImageSupp']);

if($VerifEmptyContent==0 || $VerifEmptyContent2==0){
    header('Location: ../DPIpatient/FormulaireUnlink.php?erreur=6');
}

else if($VerifPatient==0){
    header('Location: ../DPIpatient/FormulaireUnlink.php?erreur=7');
}

else{
    $fichier = "../Images/".$_POST['catSUPP']."/".$_POST['nomImageSupp'];
    if (file_exists($fichier)){
        echo "hello";
        if($_POST['catSUPP']=='Biologie'){
            $VeriCheckImage=Check_Image_Biologie($_POST["IPPImageSupp"],$fichier);
            if($VeriCheckImage==0){
                header('Location: ../DPIpatient/FormulaireUnlink.php?erreur=1');
            }else{
                echo 'parfait';
                unlink($fichier);
                Delete_Image_Biologie($fichier);
                header('Location: ../DPIpatient/DPI.php');
            }
        }
        elseif ($_POST['catSUPP']=='Courriel'){
            $VeriCheckImage=Check_Image_Courriel($_POST["IPPImageSupp"],$fichier);
            if($VeriCheckImage==0){
                header('Location: ../DPIpatient/FormulaireUnlink.php?erreur=1');
            }else{
                echo 'parfait';
                unlink($fichier);
                Delete_Image_Courriel($fichier);
                header('Location: ../DPIpatient/DPI.php');
            }
        }
        elseif ($_POST['catSUPP']=='Imagerie'){
            $VeriCheckImage=Check_Image_Imagerie($_POST["IPPImageSupp"],$fichier);
            if($VeriCheckImage==0){
                header('Location: ../DPIpatient/FormulaireUnlink.php?erreur=1');
            }else{
                echo 'parfait';
                unlink($fichier);
                Delete_Image_Imagerie($fichier);
                header('Location: ../DPIpatient/DPI.php');
            }
            }
        }
    else{
        header('Location: ../DPIpatient/FormulaireUnlink.php?erreur=5');
    }
}
