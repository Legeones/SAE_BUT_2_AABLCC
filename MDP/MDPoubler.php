<!DOCTYPE html>
<html lang=en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Mot de passe oublier</title>
    <link rel="stylesheet" href="MDPoublierCSS.css">
</head>
<body>
<form action="Verification_PasswordChange.php" method="post">
    <h1>Mot de passe oubliÃ© ?</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="formGauche">
            <div class="Groupe">
                <label for="identifiant">Identifiant : </label>
                <input type="text" placeholder="Saisir votre identifiant" name="id" />
            </div>
            <div class="Groupe">
                <label for="adresse mail">Adresse mail :</label>
                <input type="text"placeholder="Saisir votre adresse mail" name="ad" />
            </div>
        </div>
    </div>
    
    <?php
    if(isset($_GET['erreur']))
        {
            $err = $_GET['erreur'];
            if($err==1)
            { echo "<p style='color:red'>Error Message</p>"; } // A modifier
        }
    ?>
    
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Suivant">
        </div>
    </div>

    <div class="Separation2"></div>
    <div class="Inscription">
        <div class="Phraseinscrit">
            <p>Retourner Ã  la page prÃ©cÃ©dente</p>
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
