<?php

require ('../../Model/BDD/DataBase_Scenario.php');


RecupCorbeilleSce($_POST["RecupCorscenario"]);
header('Location: ../../Vue/Scenario/principaleEve.php');
