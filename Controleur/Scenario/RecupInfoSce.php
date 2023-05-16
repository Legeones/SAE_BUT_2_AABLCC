<?php


require ('../Verifiant/Verifiant.php');
require ('../../Model/BDD/DataBase_Scenario.php');



$VerifScenario=checkScenario($_POST['idscenario']);


if($VerifScenario==0){
    header('Location: ../../Vue/Scenario/choixScenario.php?erreur=7');
}

else{
    session_start();

    $info=recupInfoScenario($_POST['idscenario']);

    $eve=recupEvenScenario($_POST['idscenario']);
    foreach ($eve as $val){
        echo $val;
    }

    $_SESSION['IdScenario']=$_POST['idscenario'];
    $_SESSION['nom']=$info[0];
    $_SESSION['debut']=$info[1];
    $_SESSION['fin']=$info[2];
    $_SESSION['nbev']=$info[3];
    $_SESSION['eve']=$eve;
    $_SESSION['choixInsDes']=$_POST['inscriptionDEscincription'];

    header('Location: ../../Vue/Scenario/choixEtu.php');
}


