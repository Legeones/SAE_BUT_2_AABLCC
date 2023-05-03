<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Importation des fichiers de style -->
    <meta charset="UTF-8">
    <title>change mdp</title>
    <link rel="stylesheet" href="../CSS.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>
<body id="general">
<!-- Zone de connexion -->
<form action="../../Controleur/MDP/New_mdp.php" method="post">
    <label for="identifiant">Identifiant : </label>
    <input type="text" placeholder="Saisir votre identifiant" name="username" /><br> <!-- Demande à l'utilisateur de saisir son identifiant -->
    <label for="mot de passe"> Saisissez votre mot de passe : </label>
    <input type="text" placeholder="Saisissez votre mot de passe" name="MDP" /><br> <!-- Demande à l'utilisateur de saisir son identifiant -->
    <label for="re_mot_de_passe"> Confirmer votre mot de passe : </label>
    <input type="text" placeholder="Confirmer mot de passe" name="Re_MDP" /> <!-- Demande à l'utilisateur de confirmer son mot de passe -->

    <!-- Gestion des erreurs -->

    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        // Un message d'erreur apparaît si le mot de passe comporte moins de 8 caractères
        if($err==1){
            echo "<p style='color:red'>le mot de passse a moins de 8 caractères</p>";
        }
        // Un message d'erreur apparaît si le mot de passe et sa confirmation sont différents
        if($err==2){
            echo "<p style='color:red'>le mot de passe et sa confirmation sont différents</p>";
        }
        // Un message d'erreur apparaît si des minuscules sont ajoutées
        if($err==3){
            echo "<p style='color:red'> pas de minuscule </p>";
        }
        // Un message d'erreit apparaît si des numéros sont ajoutés
        if($err==4){
            echo "<p style='color:red'> pas de numero </p>";
        }
        // Un message d'erreut apparaît si des majuscules sont ajoutées
        if($err==5){
            echo "<p style='color:red'> pas de majusucule </p>";
        }
        // Un message d'erreur apparaît des le login est invalide
        if($err==6){
            echo "<p style='color:red'> le login est invalide </p>";
        }

    }
    ?>

    <br>
    <input type="submit" value="Confirmer">
</form>
</body>
</html>
