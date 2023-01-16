<?php
require('../BDD/DataBase_Scenario.php');


RecupCorbeilleSce($_POST["RecupCorscenario"]);
header('Location: ../Scenario/principaleEve.php');
