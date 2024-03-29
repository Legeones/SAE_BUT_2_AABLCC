<html lang="en">
<head>
    <!-- Importation des fichiers de styles -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
    <title>Aide</title>
    <link rel="stylesheet" href="../CSS.css">
</head>
<body id="general">
<!-- Zone de connexion -->

<form action="../../Controleur/Accueil/Aide_Send.php" method="POST">
    <h1>Aide</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="formGauche">
            <div class="Groupe">
                <label for="identifiant">Identifiant : </label>
                <input type="text" placeholder="Saisir votre identifiant" name="username" />
                <!-- Demande à l'utilisateur de saisir son identifiant -->
            </div>
            <div class="Groupe">
                <label for="adresse mail">Adresse mail :</label>
                <input type="text"placeholder="Saisir votre adresse mail" name="mail" />
                <!-- Demande à l'utilisateur de saisir son adresse mail -->
            </div>
        </div>
        <div class="formDroite">
            <div class="Groupe">
                <label> Message :</label>
                <input type="text" placeholder="Saisissez ici ..." name="body" />
                <!-- Zone de saisie -->
            </div>
        </div>
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Envoyer le message">
            <!-- Bouton permettant d'envoyer son message -->
        </div>
        <!-- Gestion des erreurs -->


        <?php
    //Gestion des erreurs//
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1){
            echo "<p style='color:red'> tous les champs doivent être remplis </p>";
            // Ici une erreur est affichée si tous les champs ne sont pas remplis

        }
        if($err==2){
            echo "<p style='color:red'> mail ou login invalide </p>";
            // Ici une erreur est affichée si le mail ou le login sont invalides

        }
    }
    ?>
        <!-- zone de connexion -->
    </div>
    <div class="Separation2"></div>
    <div class="Inscription">
        <div class="Phraseinscrit">
            <p>Retourner à la page précédente</p>
        </div>
        <div class="piedDePage2">
            <div class="droite">
                <input type="button" id="retour_boutton" onclick="window.history.back();return false;" value="Retour"/>
                <!-- Bouton permettant de retourner à la page précédente -->
            </div>
        </div>
    </div>
</form>
</body>
</html>
