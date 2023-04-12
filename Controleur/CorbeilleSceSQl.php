<?php
require('../Verif_Test/Verifiant.php');
require('../BDD/DataBase_Scenario.php');


addCorbeilleSce($_POST['Corscenario']);
header('Location: ../Scenario/principaleEve.php');
