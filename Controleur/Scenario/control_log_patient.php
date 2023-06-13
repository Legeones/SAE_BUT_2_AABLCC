<?php
require("../../Model/BDD/Code_log_patient.php");
require('../../Model/BDD/DataBase_Core.php');

$db = DataBase_Creator_Unit();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["nom_scenario"]) && isset($_POST["nom_etudiant"])){
        recuperation_events_via_user_and_scenario($db, $_POST["nom_scenario"], $_POST["nom_etudiant"]);
    }else{
        echo "les données sont vides !!";
    }
}
