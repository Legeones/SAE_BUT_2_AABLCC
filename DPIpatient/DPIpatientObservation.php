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
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<body>
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
            <input type="submit" name="diagramme" onmouseover="alterner('diagramme')" onmouseout="alterner('diagramme')" value="Diagramme de soins">
            <input type="submit" name="biologie" onmouseover="alterner('biologie')" onmouseout="alterner('biologie')" value="Biologie">
            <input type="submit" name="imagerie" onmouseover="alterner('imagerie')" onmouseout="alterner('imagerie')" value="Imagerie">
            <input type="submit" name="courrier" onmouseover="alterner('courrier')" onmouseout="alterner('courrier')" value="Courriers">
        </form>
        <div class="info">
            <h2>Observation médicales</h2>
            <p></p>
        </div>
        <table>
            <title>Transmissions ciblées</title>
            <tr>
                <td>Date</td>
                <td>Cible</td>
                <td>Données</td>
                <td>Resultats</td>
            </tr>
            <?php ?>
        </table>

    </div>
</div>
</body>
</html>
