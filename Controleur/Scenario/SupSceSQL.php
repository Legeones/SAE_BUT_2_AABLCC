<?php
session_start();

require ('../../Model/BDD/DataBase_Scenario.php');


supCorbeilleSce($_SESSION["SupCorscenario"]);
header('Location: ../../Vue/Scenario/principaleEve.php');