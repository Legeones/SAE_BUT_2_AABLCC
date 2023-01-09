<!DOCTYPE html>
<html lang="fr">
<html>
<head>
    <title>Principal scenario</title>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="../Images/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='../DPIpatient/DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
            <?php
            session_start();
            if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof") {
                echo "<button onclick=location.href='../Scenario/SupprimerScenario.php'>Supprimer Scenario</button>"; //Bouton permettant de supprimer des Scenario
                echo '<br>';
                echo "<button onclick=location.href='../Scenario/CorbeilleSce.php'> Mettre a la Corbeille</button>"; // Bouton permettant de mettre des Scenario dans la corbeille
                echo '<br>';
                echo "<button onclick=location.href='../Scenario/RecupCorbeilleSce.php'>Recuperer Scenario</button>"; //Bouton permettant de recupérer des Scenario dans la corbeille
                echo '<br>';
            }
            ?>
        </div>
    </div>
    <div class="droite">

        <?php
        if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof") {echo "<button onclick=location.href='choixScenario.php'>lancer scenario</button>";}
        ?>
</body>
</html>
