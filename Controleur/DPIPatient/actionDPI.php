<?php
session_start();

//echo $_SESSION['patientSuivi']; (entre L12 et L13)

//Ici nous allons chercher le fichier qui contient l'accès à la base
require("../../Model/BDD/DataBase_Dpi.php");


//Ici on va rechercher le patient cliquer dans le principale.php
foreach($_POST as $key => $items) {
    if ($key!=null){
        $_SESSION['patientSuivi'] = "".$key;
        echo $key;
    }
}

//Ici on va chercher dans quel page nous sommes
foreach($_GET as $key => $items) {
    if ($key!=null){
        $_SESSION['cat'] = "".$key;
    }
}
if($_SESSION['cat']==null){
    $_SESSION['cat']="Macrocible";
}

//Appel du Querry qui recherche les informations du patient
if ($_SESSION['patientSuivi']!="null"){
    Data_Patient_Querry($_SESSION['patientSuivi'],$_SESSION['cat']);
} else {
    header("Location: ../../Vue/DPIPatient/DPI.php");
}

?>
