<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>DPI</title>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header id="haut">
    <img class="logo" src="../Images/logoIFSI.png" alt="LogoIFSI">
    <button title="Déconnexion" id="logout" onclick="location.href='../Connexion/Deconnexion.php'"><img id="img_logout" src="../Images/Logout.png"></button>
</header>
<div class="global">
    <div id="gauche" class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg" alt="Profile">
        </div>
        <div class="btn-group">
            <button onclick="location.href='../DPIpatient/DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
            <!-- choix du rôle -->
        </div>
    </div>
    <div id="droit" class="droite">
        <form id="ajout_admission" action="patientDPIfunction.php" method="get">
            <p>Patient que vous allez admettre :</p><?php if(isset($_SESSION['infosPersoPatient']['nom'])){print($_SESSION['infosPersoPatient']['nom']." ".$_SESSION['infosPersoPatient']['prenom']);} ?>
            <input name="patient_admission" value=<?= $_SESSION['infosPersoPatient']['ipp'] ?>>
            <p>Date d'admission</p>
            <input name="date_admission" type="date">
            <br>
            <br>
            <input type="submit" value="Admettre">
        </form>
    </div>

</body>

