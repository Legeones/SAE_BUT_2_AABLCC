<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublier</title>
    <link rel="stylesheet" href="CSS.css">
</head>
<body id="general">
<form action="../Controleur/Verification_PasswordChange.php" method="post">
    <h1>Mot de passe oublié ?</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="formGauche">
            <div class="Groupe">
                <label for="identifiant">Identifiant : </label>
                <input type="text" placeholder="Saisir votre identifiant" name="username" />
            </div>
            <div class="Groupe">
                <label for="adresse mail">Adresse mail :</label>
                <input type="text"placeholder="Saisir votre adresse mail" name="mail" />
            </div>
        </div>
    </div>
    <!-- Gestion des erreurs -->


    <?php
    if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err==1){
                echo "<p style='color:red'> le mail est invalide </p>"; // Une erreur est affiché si le mail est invalide
            }
            
            if($err==2){
                echo "<p style='color:red'> tous les champs doivent être remplis </p>"; // Une erreur est affiché si tous les champs ne sont pas remplis
            }
        }
    ?>

    <!-- Zone de connexion -->

    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Suivant">
        </div>
    </div>

    <div class="Separation2"></div>
    <div class="CssUnified">
        <div class="Phrase">
            <p>Retourner à la page précédente</p>
        </div>
        <div class="piedDePage2">
            <div class="droite">
                <input type="button" onclick="window.history.back();return false;" value="Retour"/>
            </div>
        </div>
    </div>
</form>

</body>
</html>
