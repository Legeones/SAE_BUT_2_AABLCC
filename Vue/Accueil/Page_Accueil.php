<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../AccueilCSS.css">

    <form>
        <h1>Bienvenue à l'IFSI de Maubeuge</h1>
        <header>
            <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png"> <!-- importation du logo UPHF -->
        </header>
        </div>
        <!-- Ajout de boutons -->
        <div class="gauche2">
            <input type="button" onclick="window.location.href ='../Connexion/login.php';" value="Connexion "/>
            <!-- Permets d'accéder à la page connexion -->

            <input type="button" onclick="window.location.href ='Localisation.php';" value="Ou nous trouver ?"/>
            <!-- Permets d'accéder à la page ou nous trouver-->
        </div>
        <div class ="Aide">
            <input type="button" onclick="window.location.href ='../../Vue/Accueil/Aide.php';" value="Aide"/>
            <!-- Permet d'accéder à la page Aide -->

            <input type="button" onclick="window.location.href ='charte_utilisation.php';" value="Charte"/>
            <!-- Permets d'accéder à la page Charte -->

        </div>
    </form>
</head>
<body id="general">

