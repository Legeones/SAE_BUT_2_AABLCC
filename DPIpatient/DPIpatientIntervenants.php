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
        <!-- zone d'ajout de boutons -->
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input type="submit" name="macrocible" onmouseover="alterner('macrocible')" onmouseout="alterner('macrocible')" value="macrocible">
            <input type="submit" name="observation" onmouseover="alterner('observation')" onmouseout="alterner('observation')" value="Observation médicale">
            <input type="submit" name="prescription" onmouseover="alterner('prescription')" onmouseout="alterner('prescription')" value="Prescription">
            <input type="submit" name="intervenants" onmouseover="alterner('inytervenants')" onmouseout="alterner('intervenants')" value="Intervenants">
            <input type="submit" name="diagramme" onmouseover="alterner('diagramme')" onmouseout="alterner('diagramme')" value="Diagramme de soins">
            <input type="submit" name="biologie" onmouseover="alterner('biologie')" onmouseout="alterner('biologie')" value="Biologie">
            <input type="submit" name="imagerie" onmouseover="alterner('imagerie')" onmouseout="alterner('imagerie')" value="Imagerie">
            <input type="submit" name="courriers" onmouseover="alterner('courriers')" onmouseout="alterner('courriers')" value="Courriers">
        </form>
        <div class="info">
            <h2>Données personnelles</h2>
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
        <div class="container">
            <table>
                <tr>Intervenants</tr>
                <tr>
                    <td>Date</td>
                    <td>Profession</td>
                    <td>Compte rendu</td>
                </tr>
            </table>
        </div>

    </div>
</div>
</body>
</html>
