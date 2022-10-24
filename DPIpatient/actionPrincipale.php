<?php
session_start();
require ("../BDD/DataBase_Dpi.php");

if(isset($_GET['next'])){
    $_SESSION['incrPat']+=24;
}
if(isset($_GET['back'])){
    if($_SESSION['incrPat']>0){
        $_SESSION['incrPat']-=24;
    }
}

if(isset($_GET['select'])){
    $_SESSION['paramRecherche']=$_GET['select'];
} else {
    $_SESSION['paramRecherche']='aucun';
}

if(isset($_GET['recherche_barre']) && $_GET['recherche_barre']!=''){
    $_SESSION['rechercheManu']=$_GET['recherche_barre'];
} else {
    $_SESSION['rechercheManu']='aucun';
}

Patient_Parcour($_SESSION['paramRecherche'],$_SESSION['rechercheManu'])
?>
