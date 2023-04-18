<?php
session_start();
//Ici nous allons chercher le fichier qui contient l'accès à la base
require("../../Model/BDD/DataBase_Dpi.php");


//On vérifie quelles sont les actions effectuées par les utilisateurs
//Passage vers une autre page
if(isset($_GET['next'])){
    $_SESSION['incrPat']+=24;
}
if(isset($_GET['back'])){
    if($_SESSION['incrPat']>0){
        $_SESSION['incrPat']-=24;
    }
}

//Ici on regarde si l'utilisateur a passer en paramétre un ordre de tri
if(isset($_GET['select'])){
    $_SESSION['paramRecherche']=$_GET['select'];
} else {
    $_SESSION['paramRecherche']='aucun';
}

if(isset($_GET['admi'])){
    $_SESSION['paramRechercheAdmi']=$_GET['admi'];
} else {
    $_SESSION['paramRechercheAdmi']='IPP';
}

//Ici on recherche en fonction de si l'utilisateur recherche dans la barre de recherche
if(isset($_GET['recherche_barre']) && $_GET['recherche_barre']!=''){
    $_SESSION['rechercheManu']=$_GET['recherche_barre'];
} else {
    $_SESSION['rechercheManu']='aucun';
}

//L'appel à la fonction Patient_Parcour du fichier DataBase_DPI.php
Patient_Parcour($_SESSION['paramRecherche'],$_SESSION['rechercheManu'],$_SESSION['paramRechercheAdmi'])
?>
