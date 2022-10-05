<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="ConnexionCss.css" media="screen" type="text/css" />
</head>
<body>
<div id="container">
    <!-- zone de connexion -->

    <form action="verification.php" method="POST">
        <h1>Connexion</h1>
        <div class="Separation"></div>
        <div class="Formulaire">
            <div class="Groupe">
                <label for="identifiant">Identifiant : </label>
                <input type="text" placeholder="Saisir votre identifiant" name="username" />
            </div>
            <div class="Groupe">
                <label for="mot de passe">Mot de passe :</label>
                <input type="password"placeholder="Saisir votre mot de passe" name="password" />
            </div>
        </div>
        <?php
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1 || $err==2){
                echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
        }
        ?>
        <div class="piedDePage">
            <div class="Validation" align="center" >
                <input type="submit" value="Connexion">
            </div>
            <div class="mdpOublie" align="right">
                <a href="change_mdp.php"><strong>Mot de passe oublié©</strong></a>
            </div>
        </div>
        <div class="Separation2"></div>
        <div class="Inscription">
            <div class="Phraseinscrit">
                <p>Pour vous inscrire</p>
            </div>
            <div class="inscrit" align="center">
                <input type="button" onclick="window.location.href ='Inscription_formulaire.php';" value="S'inscrire"/>
            </div>
            <div class="piedDePage2">
                <div class="gauche">
                    <a href="TEST.php"><strong>Charte d'utilisation</strong></a>
                </div>
                <div class="droite">
                    <input type="button" onclick="window.location.href ='TEST.php';" value="?"/>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>