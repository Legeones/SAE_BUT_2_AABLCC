<?php

require('DataBase.php');

DataBase_Check_User_Exist($_POST['username'],$_POST['password']);

?>
