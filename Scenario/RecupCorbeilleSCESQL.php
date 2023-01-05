<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_Scenario.php');


RecupCorbeilleSce($_POST["RecupCorscenario"]);
header('Location: ../Scenario/principaleEve.php');
