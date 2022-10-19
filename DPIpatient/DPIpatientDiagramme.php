<?php
session_start();
?>
<html>
<head>
    <!-- importation des fichiers de style -->
    <meta charset="utf-8">
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
            <button onclick="location.href='principale.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <!-- zone d'ajout de boutons  -->
        <form name="cat" method="get" class="btn-line">
            <input type="button" id="macrocible" onmouseover="alterner('macrocible')" onmouseout="alterner('macrocible')" onclick="location.href='DPIpatientMacrocible.php';" value="macrocible">
            <input type="button" id="observation" onmouseover="alterner('observation')" onmouseout="alterner('observation')" onclick="location.href='DPIpatientObservation.php';" value="Observation médicale">
            <input type="button" id="prescription" onmouseover="alterner('prescription')" onmouseout="alterner('prescription')" onclick="location.href='DPIpatientPrescription.php';" value="Prescription">
            <input type="button" id="diagramme" onmouseover="alterner('diagramme')" onmouseout="alterner('diagramme')" onclick="location.href='DPIpatientDiagramme.php';" value="Diagramme de soins">
            <input type="button" id="biologie" onmouseover="alterner('biologie')" onmouseout="alterner('biologie')" onclick="location.href='DPIpatientBiologie.php';" value="Biologie">
            <input type="button" id="imagerie" onmouseover="alterner('imagerie')" onmouseout="alterner('imagerie')" onclick="location.href='DPIpatientImagerie.php';" value="Imagerie">
            <input type="button" id="courrier" onmouseover="alterner('courrier')" onmouseout="alterner('courrier')" onclick="location.href='DPIpatientCourriers.php';" value="Courriers">
        </form>

    </div>
</div>
</body>
</html>
