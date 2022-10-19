<?php

require('../BDD/DataBase_User.php');

DataBase_Check_User_Exist($_POST['username'],$_POST['password']);

?>
