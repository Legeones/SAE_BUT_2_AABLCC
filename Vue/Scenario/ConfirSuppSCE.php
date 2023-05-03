<?php
session_start();

$_SESSION["SupCorscenario"]=$_POST["SupCorscenario"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>test Dom</title>
    <link rel="stylesheet" href="../CSS_DPI.css">
</head>
<body>

<H1> etez-vous sur de vouloir supprimer ce scenario ?</H1>
<br>
<?php
//demande de confirmation pour la suppresion
echo "etes vous sur de vouloir supprimer ce scenario ";
?>
<br>
<div class="div-norm-scenario">
    <button class="btn-norm" onclick="location.href='../..Controleur/Scenario/SupSceSQL.php'">OUI</button> <!-- Bouton oui supprimer patient -->
    <button class="btn-norm" onclick="location.href='principaleEve.php'">NON</button> <!-- Bouton non supprimer patient -->
</div>

</body>
</html>
