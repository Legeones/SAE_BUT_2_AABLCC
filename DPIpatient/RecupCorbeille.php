<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Zone de connexion -->

    <meta charset="UTF-8">
    <title>Recup Patient</title>
</head>
<body>
<form action="RecupCorbeilleSQL.php" method="post">
    IPP: <input type="text" name="IPP_Recup"><br>


    <br>
    <input  type="submit" value="Confirmer" name="Confirmer" id="Confirmer">

</form>

<!-- gestion des erreurs -->

<?php
if (isset($_GET['erreur'])) {
    $err = $_GET['erreur'];
    if ($err == 1) {
        //Ici une erreur est affiché si tous les champs ne sont pas remplis //
        echo "<p style='color:red'>tous les champs doivent etre remplis</p>";
    }
    // Ici une erreur est affiché si IPP n'est pas dans la BBD //
    if ($err == 2) {
        echo "<p style='color:red'>IPP n'est pas dans la corbeille</p>";
    }
    // Ici une erreur est affiché si IPP contient des lettres //
    if ($err == 3) {
        echo "<p style='color:red'>IPP ne doit pas avoir de lettre</p>";
    }
}