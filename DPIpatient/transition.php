<?php
session_start();
// Changement de rôle
if($_SESSION["Role"]=="admin"){
    $_SESSION["Role"]="pseudo-etu";
    header("Location: DPI.php");
}

else if($_SESSION["Role"]=="prof"){
    $_SESSION["Role"]="pseudo-etu";
    header("Location: DPI.php");
}
