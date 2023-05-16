<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../CSS.css" media="screen" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Inscription</title>
</head>
<body id="general">
<!-- zone de connexion -->

<form action="../../Controleur/Verifiant/Verification_Inscription.php" method="post">
    <h1>Inscription</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="Groupe">
            <label> Identifiant : </label>
            <input type="text" placeholder="Saisir votre identifiant" name="ID" />
            <!-- Demande à l'utilisateur de saisir son identifiant -->
        </div>
        
        <div class="Groupe">
            <label> Nom : </label>
            <input type="text" placeholder="Saisir votre Nom" name="nom" />
            <!-- Demande à l'utilisateur de saisir son nom -->
        </div>
        <div class="Groupe">
            <label> Prenom : </label>
            <input type="text" placeholder="Saisir votre Prenom" name="prenom" />
            <!-- Demande à l'utilisateur de saisir son prenom -->
        </div>
        
        <div class="Groupe">
            <label> Mot de passe :</label>
            <input type="password" name="Password_A" id="password" placeholder="Saisir votre mot de passe" />
            <!-- Demande à l'utilisateur de saisir son mot de passe -->
            <em class="bi bi-eye-slash" id="togglePassword"></em>
        </div>
        <div class="Groupe">
            <label> Confirmation mot de passe : </label>
            <input type="password" name="Password_B" id="password1" placeholder="Confirmer votre mot de passe" />
            <!-- Demande à l'utilisateur de confirmer son mot de passe -->
            <em class="bi bi-eye-slash" id="togglePassword1"></em>
        </div>
        <div class="Groupe">
            <label> Adresse mail :</label>
            <input type="text"placeholder="Saisir votre adresse mail" name="email" />
            <!-- Demande à l'utilisateur de saisir votre adresse mail -->
        </div>
    </div>
    <div class="piedDePage">
        <div class="Validation" >
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
            echo "<p style='color:red'>le mot de passse a moins de 8 caractéres</p>";
            // Ici une erreur est affichée si le mot de passe contient moins de 8 caractéres

        }
        if($err==2){
            echo "<p style='color:red'>le mot de passe et sa confirmation sont différents</p>";
            // Ici une erreur est affichée si les 2 mot de passe ne sont pas identiques

        }
        if($err==3){
            echo "<p style='color:red'> pas de minuscule </p>";
            // Ici une erreur est affichée s'il y a des minuscules

        }
        if($err==4){
            echo "<p style='color:red'> pas de numero </p>";
            // Ici une erreur est affichée s'il y a des numéros

        }
        if($err==5){
            echo "<p style='color:red'> pas de majusucule </p>";
            // Ici une erreur est affichée s'il y a des majuscules

        }
        if($err==6){
            echo "<p style='color:red'> tous les champs doivent être remplis </p>";
            // Ici une erreur est affichée si les champs ne sont pas complétement remplis

        }

        if($err==7){
            echo "<p style='color:red'> mail ou login invalide </p>";
            // Ici une erreur est affichée si le mail ou le login est invalide

        }
        
        if($err==8){
            echo "<p style='color:red'> Champs nom et/ou prenom doivent être remplis </p>";
            // Ici une erreur est affichée si le nom et ou prenom sont vides

        }
    }
    ?>
        <!-- zone de connexion -->

    </div>
    <div class="Separation2"></div>
    <div class="CssUnified">
        <div class="Phrase">
            <p>Pour vous Connectez</p>
        </div>
        <div class="CSS1"">
            <input type="button" onclick="window.location.href ='../Connexion/login.php';" value="Se connecter"/>
        <!-- Bouton permettant à l'utilisateur de se connecter -->
        </div>
        <div class="piedDePage2">
            <div class="droite">
                <input type="button" onclick="window.location.href ='../../Vue/Accueil/Aide.php';" value="?"/>
                <!-- Bouton permettant d'accéder à l'aide -->
            </div>
        </div>
    </div>
</form>
</body>
</html>
