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
<div class="global">
<div class="gauche">
    <div class="profile" id="space-invader">
        <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
    </div>
    <div class="btn-group">
        <button onclick="location.href='principaleEve.php'">SCENARIOS</button>
    </div>
</div>
<div class="droite">
    <div class="bas">
        <H1> Confirmation de la suppression du scénario</H1>
        <br>
        <?php
        //demande de confirmation pour la suppresion
        echo "Êtes-vous sûr de vouloir supprimer ce scénario ?";
        echo "<br>"
        ?>

        <br>
        <div class="div-norm-scenario">
            <button class="btn-norm" onclick="location.href='../..Controleur/Scenario/SupSceSQL.php'">OUI</button>
            <!-- Bouton oui supprimer patient -->

            <button class="btn-norm" onclick="location.href='principaleEve.php'">NON</button>
            <!-- Bouton non supprimer patient -->
        </div>
    </div>
</div>


</body>
</html>
