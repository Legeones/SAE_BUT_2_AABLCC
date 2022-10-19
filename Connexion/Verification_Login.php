<?php

require('../BDD/DataBase.php');

DataBase_Check_User_Exist($_POST['username'],$_POST['password']);

?>
