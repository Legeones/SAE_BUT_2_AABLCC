<!DOCTYPE html>
<html lang=en">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="AccueilCSS.css">

    <form>
        <h1>Bienvenue à l'IFSI de Maubeuge</h1>
        <header>
            <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
        </header>
        </div>
        <!-- Ajout de boutons -->
        <div class="gauche2">
            <input type="button" onclick="window.location.href ='../Connexion/login.php';" value="Connexion "/> <!-- Permet d'accèder à la page connexion -->
            <input type="button" onclick="window.location.href ='../Connexion/Localisation.php';" value="Ou nous trouver ?"/> <!-- Permet d'accèder à la page ou nous trouver-->
        </div>
        <div class ="Aide">
            <input type="button" onclick="window.location.href ='../Connexion/Aide.php';" value="Aide"/>
            <input type="button" onclick="window.location.href ='../Charte_Utilisation/charte_utilisation.php';" value="Charte"/>

        </div>
    </form>
</head>
<body id="general">
