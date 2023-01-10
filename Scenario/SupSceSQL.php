<?php
session_start();

require('../BDD/DataBase_Scenario.php');


supCorbeilleSce($_SESSION["SupCorscenario"]);
header('Location: ../Scenario/principaleEve.php');