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
                <div class="Titreform">
                    <h1><u>Ajouter un DPI</u></h1>
                </div>
                <div class="Groupe">
                    <label> Nom : </label>
                    <input type="text" placeholder="Saisir un nom" name="nom" />
                </div>

                <div class="Groupe">
                    <label> Prénom :</label>
                    <input type="text" placeholder="Saisir un prenom" name="prenom" />
                </div>

                <div class="Groupe">
                    <label> Date de Naissance : </label>
                    <input type="date" placeholder="Saisir une date de naissance"  name="DDN"/>
                </div>

                <div class="Groupe">
                    <label> Taille en CM :</label>
                    <input type="number"placeholder="Saisir une taille en cm" name="taille" />
                </div>

                <div class="Groupe">
                    <label> Poids en KG : </label>
                    <input type="number" placeholder="Saisir un poids en kg" name="poids" />
                </div>

                <div class="Groupe">
                    <label> Adresse :</label>
                    <input type="text" placeholder="Saisir une adresse" name="adresse" />
                </div>

                <div class="Groupe">
                    <label> Code Postal : </label>
                    <input type="number" placeholder="Saisir une code postal"  name="CP"/>
                </div>

                <div class="Groupe">
                    <label> Ville :</label>
                    <input type="text"placeholder="Saisir une Ville" name="ville" />
                </div>

                <div class="Groupe">
                    <label> Téléphone Personnel :</label>
                    <input type="text" placeholder="Saisir un numéro de téléphone personnel" name="telperso" />
                </div>

                <div class="Groupe">
                    <label> Téléphone Profesionnel : </label>
                    <input type="text" placeholder="Saisir un numéro de téléphone profesionnel"  name="telpro"/>
                </div>

                <div class="Groupe">
                    <label> Alergies:</label>
                    <input type="text"placeholder="Saisir les allergies" name="allergies" />
                </div>

                <div class="Groupe">
                    <label> Antecedents : </label>
                    <input type="text" placeholder="Saisir les antecedents" name="antecedents" />
                </div>

                <div class="Groupe">
                    <label> Obstericaux :</label>
                    <input type="text" placeholder="Saisir les Obsericaux" name="Obs" />
                </div>

                <div class="Groupe">
                    <label> Document Médicaux : </label>
                    <input type="text" placeholder="Saisir le document médicaux"  name="docMed"/>
                </div>

                <div class="Groupe">
                    <label> Document Chirurgicaux :</label>
                    <input type="text"placeholder="Saisir le document chirurgicaux" name="docChir" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>















