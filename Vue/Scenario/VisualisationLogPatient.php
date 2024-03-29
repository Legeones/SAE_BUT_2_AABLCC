<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" lang="en">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
    <title>Visualisation des logs patients</title>
</head>
<body>
<header>
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div class="droite">
        <div class="bas">
                <div class="Titreform">
                    <h1><u>Visualisation des logs patients</u></h1>
                </div>
                <div class="choix_recherche">
                    <div id="research_items">
                        <label for="nom_scenario"> Nom du scenario </label> <br> <input type="text" name="nom_scenario" id="nom_scenario"> <br><br>
                        <label for="nom_etudiant"> Nom de l'étudiant </label> <br> <input type="text" name="nom_etudiant" id="nom_etudiant"> <br>
                        <ul id="tab_datas"></ul>
                    </div>
                    <br><br><br>
                </div>
                <br><br><br>
                <div class="choix_recherche" style="position: center" id="validation">
                    <br><br>
                    <button type="button" id="rechercher_s" value="rechercher_s" style="position: center">Rechercher</button>
                    <button type="reset" id="reset_recherche" value="reset_recherche"> Reset les informations</button>
                </div>
        </div>
    </div>
    <script defer src="../../Model/BDD/Code_log_patient.js"
</body>
</html>