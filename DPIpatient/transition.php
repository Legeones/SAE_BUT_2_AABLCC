<?php
session_start();

if($_SESSION["Role"]=="admin"){
    $_SESSION["Role"]="pseudo-etu";
    header("Location: principale.php");
}

else if($_SESSION["Role"]=="prof"){
    $_SESSION["Role"]="pseudo-etu";
    header("Location: principale.php");
}
