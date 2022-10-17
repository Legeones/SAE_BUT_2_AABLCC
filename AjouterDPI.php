<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="AjouterDPI_CSS.css" media="screen" type="text/css" />
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
            <button onclick="location.href='principale.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <form action="principale.php" method="get">
            <input name="recherche_barre"></input>
            <select name="select">
                <option name="aucun">Aucun</option>
                <option name="dh">Date hospitalisation</option>
                <option name="oa">Ordre alphabetique</option>
            </select>
            <button type="submit">Rechercher</button>
            <button name="next">Next</button>
            <button name="back">Back</button>
        </form>

        <div class="bas">
            <form name="form" action="">
                <div class="Groupe">
                    <label> Nom : </label>
                    <input type="text" placeholder="Saisir un nom" name="nom" />
                </div>

                <div class="Groupe">
                    <label> Prénom :</label>
                    <input type="text" placeholder="Saisir un prenom" name="prenom" />
                </div>

                <div class="Groupe">
                    <label> Confirmation mot de passe : </label>
                    <input type="password" placeholder=""  name="password_B"/>
                </div>

                <div class="Groupe">
                    <label> Adresse mail :</label>
                    <input type="text"placeholder="Saisir votre adresse mail" name="email" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>















