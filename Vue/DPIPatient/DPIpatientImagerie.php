<?php
session_start();
require ('../../Model/BDD/DataBase_Dpi.php');
require ('../../Controleur/DPIPatient/patientDPIfunction.php');
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Imagerie patient</title>
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
            <img alt="LogoIFSI" width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div class="droite">
        <script type="text/javascript" src="../../Controleur/DPIPatient/scriptsDPIpatient.js"></script>
        <!-- zone d'ajout de boutons -->
        <form action="../../Controleur/DPIPatient/actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: white;" type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input style="background-color: white;" type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input style="background-color: white;" type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input style="background-color: white;" type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input style="background-color: white;" type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input style="background-color: gray; color: white;" type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input style="background-color: white;" type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>

        <div class="container" >
            <div class="grid-container">
                <div class="info" onclick="openForm('donn-perso');">
                    <h2>Données personnelles</h2>
                </div>
            </div>
            <div class="login-popup">
                <?= afficherDataPersos() ?>
            </div>

        </div>
        <div class="container-img">
            <?php
            $result= VisuImagerie($_SESSION['infosPersoPatient']['ipp']);

            foreach ($result as $p){
                echo "<img alt='Image ' class='img' src=$p>";
                echo "<br>";
            }
            ?>
        </div>
    </div>
</div>
</body>
