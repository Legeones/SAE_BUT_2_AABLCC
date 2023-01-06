<?php
session_start();

$_SESSION["SupCorscenario"]=$_POST["SupCorscenario"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test Dom</title>
</head>
<body>

<H1> etez-vous sur de vouloir supprimer ce patient ?</H1>
<br>
<?php

echo "etes vous sur de vouloir supprimer ce scenario ";
?>
<br>

<button onclick="location.href='SupSceSQL.php'">OUI</button> <!-- Bouton oui supprimer patient -->
<button onclick="location.href='principaleEve.php'">NON</button> <!-- Bouton non supprimer patient -->
</body>
</html>
