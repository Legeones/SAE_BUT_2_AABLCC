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
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>
        <div class="container" >
            <div class="grid-container">

                <div class="info" onclick="show_data_patient_div('donn-perso');">
                    <h2>Données personnelles</h2>
                    <div class="info-intern" id="donn-perso">

                        <h4>Nom:<?php print($_SESSION['infosPersoPatient']['nom']) ?></h4>
                        <h4>Prenom:<?php print($_SESSION['infosPersoPatient']['prenom']) ?></h4>
                        <h4>Ville de naissance:</h4>
                        <h4>Date de naissance:<?php print($_SESSION['infosPersoPatient']['ddn']) ?></h4>
                        <h4>Poids:<?php print($_SESSION['infosPersoPatient']['poids_kg']) ?>kg</h4>
                        <h4>Taille:<?php print($_SESSION['infosPersoPatient']['taille_cm']) ?>cm</h4>
                        <h4>IEP:<?php print($_SESSION['infosPersoPatient']['iep']); ?></h4>
                        <h4>IPP: <?php print($_SESSION['infosPersoPatient']['ipp']); ?></h4>
                        <h4>Type hospitalisation: </h4>
                        <h4>Date d'admission: <?php print($_SESSION['infosPersoPatient']['datedebut']); ?></h4>
                        <h4>Date de sortie: <?php print($_SESSION['infosPersoPatient']['datefin']); ?></h4>
                    </div>
                </div>
            </div>

        </div>
        <div class="table-container">
            <table>
                <tr>Intervenants</tr>
                <tr>
                    <td>Date</td>
                    <td>Profession</td>
                    <td style="width: 70%; max-width: 70%;">Compte rendu</td>
                </tr>
                <?php
                $test = [["2022-10-03","Urgentiste","Pas en forme"],["2002-01-03","Médecin généraliste","En forme"]];
                foreach ($test as $item){
                    echo "<tr>";
                    echo "<td>$item[0]</td>";
                    echo "<td>$item[1]</td>";
                    echo "<td>$item[2]</td>";
                    echo "</tr>";
                }
                ?>
                <tr>
                    <td><input type="date"></td>
                    <td><input type="text"></td>
                    <td><textarea></textarea></td>
                </tr>
            </table>
            <input type="submit" value="Mettre à jour">
        </div>
    </div>
</div>
</body>
</html>
