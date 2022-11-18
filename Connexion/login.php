<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>
<body id="general">
<div id="container">
    <!-- zone de connexion -->

    <form action="Verification_Login.php" method="POST">
        <h1>Connexion</h1>
        <div class="Separation"></div>
        <div class="Formulaire">
            <div class="Groupe">
                <label for="identifiant">Identifiant : </label>
                <input type="text" placeholder="Saisir votre identifiant" name="username" /> <!-- Demande à l'utilisateur de saisir son identifiant -->
            </div>
            <div class="Groupe">
                <div class="eyes">
                    <div class="labelMDP">
                        <label for="mot de passe">Mot de passe :</label>
                    </div>
                    <div class="GroupeLOGO">
                        <input type="password" name="password" id="password" placeholder="Saisir votre mot de passe" /> <!-- Demande à l'utilisateur de saisir son mot de passe -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                    </div>
                </div>
            </div>
        </div>
        <script>
            <!-- zone de gestion d'apparition ou non du mot de passe -->

            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                this.classList.toggle("bi-eye");
            });
        </script>

        <!-- gestion des erreurs -->

        <?php
        // Ici une erreur est affiché si l'utilisateur ou le mot de passe sont incorrect
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1 || $err==2){
                echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
            }
        }
        ?>

        <!-- zone de connexion -->

        <div class="piedDePage">
            <div class="Validation" align="center" >
                <input type="submit" value="Connexion">
            </div>
            <div class="mdpOublie" align="right">
                <a href="../MDP/MDPoublier.php"><strong>Mot de passe oublié</strong></a> <!-- Permet d'accèder à la page mot de passe oublié -->
            </div>
        </div>
        <div class="Separation2"></div>
        <div class="CssUnified">
            <div class="Phrase">
                <p>Pour vous inscrire</p>
            </div>
            <div class="CSS1" align="center">
                <input type="button" onclick="window.location.href ='../Inscription/Inscription_formulaire.php';" value="S'inscrire"/>
            </div>
            <div class="piedDePage2">
                <div class="gauche">
                    <a href="../Charte_Utilisation/charte_utilisation.php"><strong>Charte d'utilisation</strong></a> <!-- Permet d'accéder à la page charte d'utilisation -->
                </div>
                <div class="droite">
                    <input type="button" onclick="window.location.href ='Aide.php';" value="?"/> <!-- Permet d'accéder à la page aide -->
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
