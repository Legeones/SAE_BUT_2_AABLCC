<?php
session_start();

$_SESSION["IPP_SUPP"]=$_POST["IPP_SUPP"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test Dom</title>
</head>
<body>

<H1> etez-vous sur de vouloir supprimer ce patient</H1>
<br>
<?php

echo $_SESSION["IPP_SUPP"];
?>
<br>

<button onclick="location.href='SupprimerPatientSQL.php'">OUI</button> <!-- Bouton oui supprimer patient -->
<button onclick="location.href='SupprimerPatient.php'">NON</button> <!-- Bouton non supprimer patient -->
</body>
</html>
