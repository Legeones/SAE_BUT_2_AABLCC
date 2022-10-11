<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="InscriptionCSS.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
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
            <input type="password" name="Password_A" id="password" placeholder="Saisir votre mot de passe" />
            <i class="bi bi-eye-slash" id="togglePassword"></i>
        </div>
        <div class="Groupe">
            <label> Confirmation mot de passe : </label>
            <input type="password1" name="Password_B" id="password1" placeholder="Saisir votre mot de passe" />
            <i class="bi bi-eye-slash" id="togglePassword1"></i>
        </div>
        <div class="Groupe">
            <label> Adresse mail :</label>
            <input type="text"placeholder="Saisir votre adresse mail" name="email" />
        </div>
        Role :
        <input type="radio" name="Role" value="etu"> etu
        <input type="radio" name="Role" value="prof"> prof
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Inscription">
        </div>
        <script>
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
            const togglePassword1 = document.querySelector("#togglePassword1");
            const password1 = document.querySelector("#password1");
            togglePassword1.addEventListener("click", function () {
                // toggle the type attribute
                const type = password1.getAttribute("type") === "password1" ? "text" : "password1";
                password1.setAttribute("type", type);
                // toggle the icon
                this.classList.toggle("bi-eye");
            });
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
