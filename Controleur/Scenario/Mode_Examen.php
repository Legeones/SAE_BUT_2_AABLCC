<?php

require ("../../Model/BDD/DataBase_Scenario.php");



if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
function liste_nom_senario(){
    return lst_deroulante_nom_Scenario();
}



