<html lang=en">
<head>
    <!-- Importation des fichiers de styles -->

    <meta charset="UTF-8">
    <title>Aide</title>
    <link rel="stylesheet" href="../Verif_Test/CSS.css">
</head>
<body>
<!-- Zone de connexion -->

<form action="Aide_Send.php" method="POST">
    <h1>Aide</h1>
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
        <div class="formDroite">
            <div class="Groupe">
                <label> Message :</label>
                <textarea type="text" placeholder="Saisissez ici ..." name="body" ></textarea>
            </div>
        </div>
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Envoyer le message">
        </div>
        <!-- Gestion des erreurs -->


        <?php
    //Gestion des erreurs//
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1){
            echo "<p style='color:red'> tous les champs doivent être remplis </p>";
        }
        
        if($err==2){
            echo "<p style='color:red'> mail ou login invalide </p>";
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
                <input type="button" onclick="window.history.back();return false;" value="Retour"/>
            </div>
        </div>
    </div>
</form>
</body>
</html>
