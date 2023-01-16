<?php
session_start();
require "patientDPIfunction.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img class="logo" src="../Images/logoIFSI.png">
</header>
<body>
<!-- Zone de connexion -->

<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div class="droite">
        <script type="text/javascript" src="scriptsDPIpatient.js"></script>
        <!-- zone d'ajout de boutons -->
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: white;" type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: gray; color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input style="background-color: white;" type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input style="background-color: white;" type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
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
        <div class="login-popup">
            <?= afficherDataPersos() ?>
            <div class="info-popup" id="obs-medi">
                <?php
                foreach ($_SESSION['observationsMed'] as $item){
                    echo "<div>";
                    echo "<p> Le ".$item['dateom']." : ".$item['rapport']."</p>";
                    echo "<p>"."</p>";
                    echo "</div>";
                }
                ?>
                <button onclick="closeForm('obs-medi')">Fermer</button>
            </div>
        </div>

        <div style="overflow-x: scroll; overflow-y: scroll;">
            <form method="get" action="patientDPIfunction.php" class="table-container">
                <table>
                    <caption>Transmission ciblée</caption>
                    <tr>
                        <td>Date</td>
                        <td>Initiales</td>
                        <td>Cible</td>
                        <td>Données</td>
                        <td>Actions</td>
                        <td>Resultats</td>
                    </tr>
                    <?php
                        foreach ($_SESSION['transmissionCib'] as $item){
                            echo "<tr>";
                            echo "<td>".$item['date']."</td>";
                            echo "<td>".$item['initiale']."</td>";
                            echo "<td>".$item['cible']."</td>";
                            echo "<td>".$item['donnee']."</td>";
                            echo "<td>".$item['actions']."</td>";
                            echo "<td>".$item['resultat']."</td>";
                            echo "</tr>";
                        }
                    ?>
                    <tr>
                        <td><input name="date" type="date"></td>
                        <td><input name="init" type="text" placeholder="Initiales intervenants"></td>
                        <td><input name="cible" type="text" placeholder="Catégorie ciblée"></td>
                        <td><textarea name="donn"></textarea></td>
                        <td><textarea name="actions"></textarea></td>
                        <td><textarea name="result"></textarea></td>
                    </tr>

                </table>
                <input type="submit" value="Mettre à jour">
            </form>
        </div>

    </div>
</div>
</body>
</html>
