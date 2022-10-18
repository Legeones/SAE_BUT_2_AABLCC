<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supprimer Patient</title>
</head>
<body>
<form action="ConfirSupp.php" method="post">
    IPP: <input type="text" name="IPP_SUPP"><br>


    <br>
    <input  type="submit" value="Confirmer" name="Confirmer" id="Confirmer">

</form>


<?php
if (isset($_GET['erreur'])) {
    $err = $_GET['erreur'];
    if ($err == 1) {
        echo "<p style='color:red'>tous les champs doivent etre remplis</p>";
    }

    if ($err == 2) {
        echo "<p style='color:red'>IPP n'est pas dans la BDD</p>";
    }
    if ($err == 3) {
        echo "<p style='color:red'>IPP ne doit pas avoir de lettre</p>";
    }
}


?>
