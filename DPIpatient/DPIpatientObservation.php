<?php
session_start();
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
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <script type="text/javascript" src="scriptsDPIpatient.js"></script>
        <!-- zone d'ajout de boutons -->
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: gray; color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>
        <div class="container">
                <div class="grid-container">
                    <div class="info" onclick="show_data_patient_div('donn-pers');">
                        <h2>Données personnelles</h2>
                        <div class="info-intern" id="donn-pers">
                            <h4>Nom:<?php print($_SESSION['infosPersoPatient']['nom']) ?></h4> <!-- Permet d'afficher le nom de la personne cherchée dans la base de données -->
                            <h4>Prenom:<?php print($_SESSION['infosPersoPatient']['prenom']) ?></h4> <!-- Permet d'afficher le prénom de la personne cherchée dans la base de données -->
                            <h4>Ville de naissance:</h4> <!-- Onglet ville de naissance -->
                            <h4>Date de naissance:<?php print($_SESSION['infosPersoPatient']['ddn']) ?></h4> <!-- Permet d'afficher la date de naissance de la personne cherchée dans la base de données -->
                            <h4>Poids:<?php print($_SESSION['infosPersoPatient']['poids_kg']) ?>kg</h4> <!-- Permet d'afficher le poids de la personne cherchée dans la base de données -->
                            <h4>Taille:<?php print($_SESSION['infosPersoPatient']['taille_cm']) ?>cm</h4> <!-- Permet d'afficher la taille de la personne cherchée dans la base de données -->
                            <h4>IEP:<?php print($_SESSION['infosPersoPatient']['iep']); ?></h4> <!-- Permet d'afficher l'iep de la personne cherchée dans la base de données -->
                            <h4>IPP: <?php print($_SESSION['infosPersoPatient']['ipp']); ?></h4> <!-- Permet d'afficher l'ipp de la personne cherchée dans la base de données -->
                            <h4>Type hospitalisation: </h4> <!-- Onglet type d'hospitalisation -->
                            <h4>Date d'admission: <?php print($_SESSION['infosPersoPatient']['datedebut']); ?></h4> <!-- Permet d'afficher la date début d'hospitalisation de la personne cherchée dans la base de données -->
                            <h4>Date de sortie: <?php print($_SESSION['infosPersoPatient']['datefin']); ?></h4> <!-- Permet d'afficher la date de sortie d'hospitalisation de la personne cherchée dans la base de données -->
                        </div>

                    </div>
                    <div class="info" onclick="show_data_patient_div('obs-medi');">
                        <h2>Observation médicales</h2>
                        <div class="info-intern" id="obs-medi">
                            <?php
                            foreach ($_SESSION['observationsMed'] as $item){
                                echo "<div>";
                                echo "<p> Le ".$item['dateom']." : ".$item['rapport']."</p>";
                                echo "<p>"."</p>";
                                echo "</div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
        </div>
        <form class="table-container">
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
                    <td><input type="date"></td>
                    <td><input type="text"></td>
                    <td><input type="text"></td>
                    <td><textarea></textarea></td>
                    <td><textarea></textarea></td>
                    <td><textarea></textarea></td>
                </tr>

            </table>
            <input type="submit" value="Mettre à jour">
        </form>

    </div>
</div>
</body>
</html>
