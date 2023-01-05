<?php
session_start();
require("Principal_PHP_Fonction_DPI_ADD_or_Modif.php");

?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
    <script src="scriptsDPIpatient.js"></script>

</head>
<body>
<header>
    <!-- Ajout du logo -->
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>


    <!-- zone de connexion -->
    <div class="droite">
        <div class="bas">
            <br>
            <div id="accueil_bouton_mdf" class="accueil_bouton_mdf" >
                <div class="Titreform">
                    <h1 class="Question_mdf"><u>Que voulez-vous modifier</u></h1>
                </div>
                <button type="button" id="bouton1" onclick="location.href='MDFDPI.php'"><label><b>Patient</b></label></button><br>
                <button type="button" id="bouton2" onclick="location.href='MDF_Personne_de_contacte.php'"><label><b>Personne de Contacte</b></label></button>
                <button type="button" id="bouton3" onclick="location.href='MDF_Personne_de_confiance.php'"><label><b>Personne de Confiance</b></label></button>

            </div>
        </div>
    </div>
</div>
</body>
</html>
