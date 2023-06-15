<?php

require ('../../Model/BDD/DataBase_User.php');
echo ($_POST['username']);

DataBase_Check_User_Exist($_POST['username'],$_POST['password']);
// Permets la vérification du login (username,password)


?>
