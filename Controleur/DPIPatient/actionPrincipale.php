<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
//Ici nous allons chercher le fichier qui contient l'accès à la base
require("../../Model/BDD/DataBase_Dpi.php");


//On vérifie quelles sont les actions effectuées par les utilisateurs
//Passage vers une autre page
if(!isset($_SESSION['incrPat'])){
    $_SESSION['incrPat'] = 0;
}

if(isset($_GET['action'])){
    if ($_GET['action'] === "next"){
        $_SESSION['incrPat']+=24;
    } else if ($_GET['action'] === "back"){
        if($_SESSION['incrPat']>0){
            $_SESSION['incrPat']-=24;
        }
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

if (isset($_GET['DPI'])){
    $_SESSION['name_senario'] = $_GET['DPI'];
}else {
    $_SESSION['name_senario'] = 'defaut';
}


if (!isset($_SESSION['exam'])) {
    $_SESSION['exam'] = 1;
}

function session_mode($val)
{
    $_SESSION['exam'] = $val;
    return $_SESSION['exam'];
}



if (isset($_GET['valeur_session'])){
    echo json_encode(session_mode($_GET['valeur_session']));
}

//L'appel à la fonction Patient_Parcour du fichier DataBase_DPI.php
if ($_SESSION['exam'] == 2){
    $return_exam = Patient_Parcour_exam($_SESSION['name_senario']);
    echo json_encode($return_exam);
}else if ($_SESSION['exam'] == 1){
    $return = Patient_Parcour($_SESSION['paramRecherche'], $_SESSION['rechercheManu'], $_SESSION['paramRechercheAdmi']);
    echo json_encode($return);
}

?>