<?php
session_start();
require ('../../Controleur/DPIPatient/Principal_PHP_Fonction_DPI_ADD_or_Modif.php')

?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
    <script src="../../Controleur/DPIPatient/scriptsDPIpatient.js"></script>

</head>
<body>
<header id="haut">
    <img class="logo" src="../../Images/logoIFSI.png" alt="LogoIFSI">
    <button type="button" title="Déconnexion" id="logout" class="logout" onclick="location.href='../Accueil/Deconnexion.php'"><img id="img_logout" src="../../Images/Logout.png"></button>
</header>
<div class="global">
    <?php
    include('../../Vue/Include/Menu_bouton.php')
    ?>

    <div class="droite">
        <div class="bas">
            <br>
            <div id="accueil_bouton_mdf" class="accueil_bouton_mdf" align="center">
                <div class="Titreform">
                    <h1 class="Question_mdf"><u>Que voulez-vous modifier</u></h1>
                </div>
                <button type="button" id="bouton1" onclick="location.href='MDFDPI.php'"><label><b>Patient</b></label></button><br> <!-- Permet d'accèder à l'onglet Patient -->
                <button type="button" id="bouton2" onclick="location.href='MDF_Personne_de_contacte.php'"><label><b>Personne de Contacte</b></label></button> <!-- Permet d'accèder à l'onglet Personne de Contacte -->
                <button type="button" id="bouton3" onclick="location.href='MDF_Personne_de_confiance.php'"><label><b>Personne de Confiance</b></label></button> <!-- Permet d'accèder à l'onglet Personne de Confiance -->

            </div>
        </div>
    </div>
</div>
</body>
</html>
