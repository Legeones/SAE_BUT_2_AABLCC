<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>change mdp</title>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Connexion/ConnexionCss.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>
<body>
    <!-- zone de connexion -->
<form action="New_mdp.php" method="post">
    <label for="identifiant">Identifiant : </label>
    <input type="text" placeholder="Saisir votre identifiant" name="username" /><br>
    <label for="mot de passe"> Saisissez votre mot de passe : </label>
    <input type="text" placeholder="Saisissez votre mot de passe" name="MDP" /><br>
    <label for="re_mot_de_passe"> Confirmer votre mot de passe : </label>
    <input type="text" placeholder="Confirmer mot de passe" name="re_MDP" />
    
<!-- Zone de gestion des erreurs -->
    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1){
            echo "<p style='color:red'>le mot de passse a moins de 8 caractères</p>";
        }
        if($err==2){
            echo "<p style='color:red'>le mot de passe et sa confirmation sont diffèrents</p>";
        }
        if($err==3){
            echo "<p style='color:red'> pas de minuscule </p>";
        }
        if($err==4){
            echo "<p style='color:red'> pas de numero </p>";
        }
        if($err==5){
            echo "<p style='color:red'> pas de majusucule </p>";
        }
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