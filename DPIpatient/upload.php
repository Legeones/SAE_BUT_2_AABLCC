<?php

require ("../Verif_Test/Verifiant.php");
require('../BDD/DataBase_Dpi.php');



$VerifEmptyContent=VerifEmptyContent($_POST["IPPImage"]);
$VerifPatient=Check_Patient($_POST['IPPImage']);

if($VerifEmptyContent==0){
    header('Location: ../DPIpatient/FormulaireUpload.php?erreur=6');
}

if($VerifPatient==0){
    header('Location: ../DPIpatient/FormulaireUpload.php?erreur=7');
}

// Vérifier si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Vérifie si le fichier a été uploadé sans erreur.
    if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["photo"]["name"];
        $filetype = $_FILES["photo"]["type"];
        $filesize = $_FILES["photo"]["size"];

        // Vérifie l'extension du fichier
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if(!array_key_exists($ext, $allowed)) header('Location: ../DPIpatient/FormulaireUpload.php?erreur=1');

        // Vérifie la taille du fichier - 5Mo maximum
        $maxsize = 5 * 1024 * 1024;
        if($filesize > $maxsize) header('Location: ../DPIpatient/FormulaireUpload.php?erreur=2');

        // Vérifie le type MIME du fichier
        if(in_array($filetype, $allowed)){
            // Vérifie si le fichier existe avant de le télécharger.
            if(file_exists("../Images/".$_POST['cat']."/" . $_FILES["photo"]["name"])){
                header('Location: ../DPIpatient/FormulaireUpload.php?erreur=5');
            } else{
                move_uploaded_file($_FILES["photo"]["tmp_name"], "../Images/".$_POST['cat']."/". $_FILES["photo"]["name"]);
                if($_POST['cat']=='Biologie'){
                    ADD_Image_Bio($_POST['IPPImage'],"../Images/".$_POST['cat']."/". $_FILES["photo"]["name"]);
                }
                else if($_POST['cat']=='Imagerie'){
                    ADD_Image_Rad($_POST['IPPImage'],"../Images/".$_POST['cat']."/". $_FILES["photo"]["name"]);
                }
                else if($_POST['cat']=='Courriel'){
                    ADD_Image_Cour($_POST['IPPImage'],"../Images/".$_POST['cat']."/". $_FILES["photo"]["name"]);
                }
                header('Location: ../DPIpatient/DPI.php');
                //var_dump($_FILES['photo']);
            }
        } else{
            header('Location: ../DPIpatient/FormulaireUpload.php?erreur=3');
        }
    } else{
        header('Location: ../DPIpatient/FormulaireUpload.php?erreur=4');
    }
}
?>