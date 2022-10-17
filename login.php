<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="ConnexionCss.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>
<body>
<div id="container">
    <!-- zone de connexion -->

    <form action="Verification_Login.php" method="POST">
        <h1>Connexion</h1>
        <div class="Separation"></div>
        <div class="Formulaire">
            <div class="Groupe">
                <label for="identifiant">Identifiant : </label>
                <input type="text" placeholder="Saisir votre identifiant" name="username" />
            </div>
            <div class="Groupe">
                <div class="eyes">
                    <div class="labelMDP">
                        <label for="mot de passe">Mot de passe :</label>
                    </div>
                    <div class="GroupeLOGO">
                        <input type="password" name="password" id="password" placeholder="Saisir votre mot de passe" />
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </div>
                </div>
            </div>
        </div>
        <script>
            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                this.classList.toggle("bi-eye");
            });
        </script>

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
                <a href="MDPoubler.php"><strong>Mot de passe oublié</strong></a>
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
                    <a href="charte_utilisation.html"><strong>Charte d'utilisation</strong></a>
                </div>
                <div class="droite">
                    <input type="button" onclick="window.location.href ='Aide.php';" value="?"/>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
