<?php
require('../../Model/BDD/DataBase_Scenario.php');

function ajoutevenement($nom, $des, $cat)
{
    if ($cat != "" and $des != "" and $nom != "") {
        insertEven($nom, $des, $cat);
        header('Location: ../../Vue/Scenario/principaleEve.php');
    } else {
        header("Location: ../../Vue/Scenario/addEvenement.php");
    }
}

function gestionEvenement()
    {

    }

if($_POST['submitEvenadd']=="suivant"){

    ajoutevenement($_POST['nomEve'],$_POST['desEve'],$_POST['catEve']);

}