<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="InscriptionCSS.css" media="screen" type="text/css" />
    <title>Inscription_Test</title>
</head>
<body>
<form action="inscription.php" method="post">
    <h1>Inscription</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="Groupe">
            <label> Identifiant : </label>
            <input type="text" placeholder="Saisir votre identifiant" name="ID" />
        </div>
        <div class="Groupe">
            <label> Mot de passe :</label>
            <input type="password"placeholder="Saisir votre mot de passe" name="Password_A" />
        </div>
        <div class="Groupe">
            <label> Confirmation mot de passe : </label>
            <input type="password" placeholder="Confirmer votre mot de passe" name="Password_B" />
        </div>
        <div class="Groupe">
            <label> Adresse mail :</label>
            <input type="text"placeholder="Saisir votre adresse mail" name="email" />
        </div>
        role
        <input type="radio" name="Role" value="etu"> etu
        <input type="radio" name="Role" value="prof"> prof
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Inscription">
        </div>
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
            echo "<p style='color:red'> tous les champs doivent être remplis </p>";
        }

        if($err==7){
            echo "<p style='color:red'> mail ou login invalide </p>";
        }
    }
    ?>

    </div>
    <div class="Separation2"></div>
    <div class="Connexion1">
        <div class="Phraseconnect">
            <p>Pour vous Connectez</p>
        </div>
        <div class="connect" align="center">
            <input type="button" onclick="window.location.href ='login.php';" value="Se connecter"/>
        </div>
        <div class="piedDePage2">
            <div class="droite">
                <input type="button" onclick="window.location.href ='Aide.php';" value="?"/>
            </div>
        </div>
    </div>
</form>
</body>
</html>