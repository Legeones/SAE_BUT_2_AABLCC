<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page de déconnexion</title>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS.css">

<form>
    <!-- zone de connexion -->
    <div class="deconnexion">
    <h1>Vous avez été déconnecté avec succès</h1>
    <header>
        <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
    </header>
        <div class="gauche2">
            <input type="button" onclick="window.location.href ='../Connexion/login.php';" value="Connexion"/> <!-- Permets d'accèder à la page Connexion -->
    </div>
        <div class ="Aide">
            <input type="button" onclick="window.location.href ='../Connexion/Page_Accueil.php';" value="Accueil"/> <!-- Permets d'accèder à la page Accueil -->
            </div>
        <?php session_start(); session_destroy();?>
</form>
</head>
<body id="general">
