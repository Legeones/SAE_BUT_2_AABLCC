<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Inscription/InscriptionCSS.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Inscription</title>
</head>
<body>
<!-- zone de connexion -->

<form action="Verification_Inscription.php" method="post">
    <h1>Inscription</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="Groupe">
            <label> Identifiant : </label>
            <input type="text" placeholder="Saisir votre identifiant" name="ID" />
        </div>
        <div class="Groupe">
            <label> Mot de passe :</label>
            <input type="password" name="Password_A" id="password" placeholder="Saisir votre mot de passe" />
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>
        <div class="Groupe">
            <label> Confirmation mot de passe : </label>
            <input type="password" name="Password_B" id="password1" placeholder="Confirmer votre mot de passe" />
            <i class="bi bi-eye-slash" id="togglePassword1"></i>
        </div>
        <div class="Groupe">
            <label> Adresse mail :</label>
            <input type="text"placeholder="Saisir votre adresse mail" name="email" />
        </div>
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Inscription">
        </div>
        <script>
            <!-- zone de gestion d'apparition ou non du mot de passe -->

            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            togglePassword.addEventListener("click", function () {
                // toggle the type attribute
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                // toggle the icon
                this.classList.toggle("bi-eye");
            });
        </script>
        <script>
            <!-- zone de gestion d'apparition ou non du mot de passe -->

            const togglePassword1 = document.querySelector("#togglePassword1");
            const password1 = document.querySelector("#password1");
            togglePassword1.addEventListener("click", function () {
                // toggle the type attribute
                const type = password1.getAttribute("type") === "password" ? "text" : "password";
                password1.setAttribute("type", type);
                // toggle the icon
                this.classList.toggle("bi-eye");
            });

            <!-- zone de gestion des erreurs -->
        </script>
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
        <!-- zone de connexion -->

    </div>
    <div class="Separation2"></div>
    <div class="Connexion1">
        <div class="Phraseconnect">
            <p>Pour vous Connectez</p>
        </div>
        <div class="connect" align="center">
            <input type="button" onclick="window.location.href ='../Connexion/login.php';" value="Se connecter"/>
        </div>
        <div class="piedDePage2">
            <div class="droite">
                <input type="button" onclick="window.location.href ='../Connexion/Aide.php';" value="?"/>
            </div>
        </div>
    </div>
</form>
</body>
</html>
