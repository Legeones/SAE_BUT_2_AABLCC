<?php

require ('../Verifiant/Verifiant.php');
require ('../../Model/BDD/DataBase_Scenario.php');


addCorbeilleSce($_POST['Corscenario']);
header('Location: ../../Vue/Scenario/principaleEve.php');
