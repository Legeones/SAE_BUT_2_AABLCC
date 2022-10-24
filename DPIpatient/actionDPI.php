<?php
session_start();
require ("../BDD/DataBase_Dpi.php");
foreach($_POST as $key => $items) {
    if ($key!=null){
        $_SESSION['patientSuivi'] = "".$key;
    }
}
//print $_SESSION['patientSuivi'];
Data_Patient_Querry($_SESSION['patientSuivi']);
//header("Location: ../DPIpatient/DPIpatientMacrocible.php");
?>