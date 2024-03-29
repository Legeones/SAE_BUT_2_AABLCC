<?php
session_start();
require ('../../Controleur/DPIPatient/patientDPIfunction.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Intervenants patient</title>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img alt="LogoIFSI" class="logo" src="../../Images/logoIFSI.png">
</header>
<body>
<!-- Zone de connexion -->

<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img alt="Profile" width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div class="droite">
        <script type="text/javascript" src="../../Controleur/DPIPatient/scriptsDPIpatient.js"></script>
        <form action="../../Controleur/DPIPatient/actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: white;"  type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input style="background-color: white;" type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input style="background-color: gray; color: white;" type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input style="background-color: white;" type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input style="background-color: white;" type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input style="background-color: white;" type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input style="background-color: white;" type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>
        <div class="container" >
            <div class="grid-container">
                <div class="info" onclick="openForm('donn-perso');">
                    <h2>Données personnelles</h2>
                </div>
            </div>
        </div>
        <div class="login-popup">
            <?= afficherDataPersos() ?>
        </div>
        <div class="table_container">
            <form action="../../Controleur/DPIPatient/patientDPIfunction.php" method="get" class="table-container">
                <table class="styled-table">
                    <caption>Intervenants</caption>
                    <thead>
                        <td>Date</td>
                        <td>Profession</td>
                        <td style="width: 70%; max-width: 70%;">Compte rendu</td>
                    </thead>
                    <?php
                    foreach ($_SESSION['infosPatient'] as $item){?>
                        <tr>
                        <td><?=$item['date']?></td>
                        <td><?=$item['fonction']?></td>
                        <td><?=$item['compterendu']?></td>
                        </tr>
                    <?php }
                    ?>
                    <tr>
                        <td><label><input type="date" name="date"></label></td>
                        <td><label><input type="text" name="fonction" placeholder="Fonction du personnel"></label></td>
                        <td><label><textarea name="compterendu" placeholder="Compte rendu"></textarea></label></td>
                    </tr>
                </table>
                <label><input type="submit" value="Mettre à jour"></label>
            </form>
        </div>
    </div>
</div>
</body>