<?php
session_start();
?>
<html>
<head>
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
    <script>
        document.getElementById('macrocible').style.backgroundColor = "cornflowerblue";
        function changer(id){
            var doc = document.getElementById(id);
            doc.style.backgroundColor = "cornflowerblue";
        }
    </script>
    <div class="droite">
        <div class="btn-line">
            <button id="macrocible" onclick="changer("macrocible")">Macrocible</button>
            <button id="observation-medicale">Observation médicale</button>
            <button id="presccription">Prescription</button>
            <button id="diagramme-de-soins">Diagramme de soins</button>
            <button id="biologie">Biologie</button>
            <button id="imagerie">Imagerie</button>
            <button id="courriers">Courriers</button>
        </div>
    </div>
</div>
</body>
</html>
