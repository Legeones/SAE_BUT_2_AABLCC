<!DOCTYPE html>
<html lang="en">
<head>
	<title>Connection</title>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS.css" media="screen" type="text/css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

</head>
<div class="droite">
    <br><select name="l">
        <option value="fr" selected="selected">Français</option>
    </select>
    <div class="retour">
        <input type="button" onclick="window.location.href ='login.php';" value="Go"/>
    </div>
</div>
<body id="general">
<div id="container">
    <!-- zone de connexion -->

    <form action="Verification_Login.php" method="POST">
        <h1>Connection</h1>
        <div class="Separation"></div>
        <div class="Formulaire">
            <div class="Groupe">
                <label for="identifiant">ID : </label>
                <input type="text" placeholder="Enter your ID" name="username" /> <!-- Demande à l'utilisateur de saisir son identifiant -->
            </div>
            <div class="Groupe">
                <div class="eyes">
                    <div class="labelMDP">
                        <label for="mot de passe">Password :</label>
                    </div>
                    <div class="GroupeLOGO">
                        <input type="password" name="password" id="password" placeholder="Enter your password" /> <!-- Demande à l'utilisateur de saisir son mot de passe -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
                        <em class="bi bi-eye-slash" id="togglePassword"></em>
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
        // Ici une erreur est affichÃ© si l'utilisateur ou le mot de passe sont incorrect
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1 || $err==2){
                echo "<p style='color:red'>Incorrect username or password</p>";
            }
        }
        ?>

        <!-- zone de connexion -->

        <div class="piedDePage">
            <div class="Validation">
                <input type="submit" value="Connection">
            </div>
            <div class="mdpOublie">
                <a href="../MDP/MDPoublier.php"><strong>Forgot your password</strong></a> <!-- Permet d'accéder à la page mot de passe oubliée -->
            </div>
        </div>
        <div class="Separation2"></div>
        <div class="CssUnified">
            <div class="Phrase">
                <p>To register</p>
            </div>
            <div class="CSS1">
                <input type="button" onclick="window.location.href ='../Inscription/Inscription_formulaire.php';" value="Register"/>
            </div>
            <div class="piedDePage2">
                <div class="gauche">
                    <a href="../Charte_Utilisation/charte_utilisation.php"><strong>User Charter</strong></a> <!-- Permet d'accéder à la page charte d'utilisation -->
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
