<?php
session_start();
// Changement de rôle
if($_SESSION["Role"]=="admin" || $_SESSION["Role"]=="prof"){
    $_SESSION["Role"]="pseudo-etu";
    header("Location: DPI.php");
}
