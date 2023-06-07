<?php
require("../../Model/BDD/Code_log_patient.php");
require('../../Model/BDD/DataBase_Core.php');

$db = DataBase_Creator_Unit();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["nom_scenario"]) && isset($_GET["nom_etudiant"])){
        recuperation_events_via_user_and_scenario($db, $_GET["nom_scenario"], $_GET["nom_etudiant"]);
    }else{
        echo "les données sont vides !!";
    }
}
