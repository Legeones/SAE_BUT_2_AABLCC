<!DOCTYPE html>
<html lang=en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="AideCss.css">
</head>
<body>
<form action="site.php" method="GET">
    <h1>Aide</h1>
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
            <div class="Groupe">
                <label for="telephone">Téléphone :</label>
                <input type="text"placeholder="Saisir votre numéro" name="tel" />
            </div>
        </div>
        <div class="formDroite">
            <div class="Groupe">
                <label> Message :</label>
                <textarea type="text" placeholder="Saisissez ici ..."></textarea>
            </div>
        </div>


    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Envoyer le message">
        </div>
        <div class="mdpOublie" align="right">
            <a href="TEST.php"><strong>Mot de passe oublié</strong></a>
        </div>
    </div>
    <div class="Separation2"></div>
    <div class="Inscription">
        <div class="Phraseinscrit">
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