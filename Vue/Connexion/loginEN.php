<!DOCTYPE html>
<html lang="en">
<head>
	<title>Connection</title>
    <meta charset="utf-8">
    <!-- importing style files -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css"/>
    <link rel="stylesheet" href="../CSS.css" media="screen" type="text/css" />

</head>
<div class="button">
    <input type="button" id="bouton_englais" onclick="window.location.href ='login.php';" value="Français"/>
</div>
<body id="general">
<div id="container">
    <!-- login area -->

    <form action="../../Controleur/Verifiant/Verification_Login.php" method="POST">
        <h1>Connection</h1>
        <div class="Separation"></div>
        <div class="Formulaire">
            <div class="Groupe">
                <label for="identifiant">ID : </label>
                <input type="text" placeholder="Enter your ID" name="username" /> <!-- Ask the user to enter their username -->
            </div>
            <div class="Groupe">
                <div class="eyes">
                    <div class="labelMDP">
                        <label for="mot de passe">Password :</label>
                    </div>
                    <div class="GroupeLOGO">
                    <input type="password" name="password" id="password" placeholder="Enter your password" /> <!-- Ask the user to enter their password -->
                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
                        <em class="bi bi-eye-slash" id="togglePassword"></em> <!-- class allowing the appearance or not of the password -->
                    </div>
                </div>
            </div>
        </div>
        <script>
            <!-- Area for managing the appearace or not of the password -->

            const togglePassword = document.querySelector("#togglePassword");
            const password = document.querySelector("#password");
            togglePassword.addEventListener("click", function () {
                const type = password.getAttribute("type") === "password" ? "text" : "password";
                password.setAttribute("type", type);
                this.classList.toggle("bi-eye");
            });
        </script>

        <!-- error management -->

        <?php
        // here an error is dsplayed if the username or password is incorrect
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1 || $err==2){
                echo "<p style='color:red'>Incorrect username or password</p>";
            }
        }
        ?>

        <!-- Login area -->

        <div class="piedDePage">
            <div class="Validation">
                <input type="submit" value="Connection">
            </div>
            <div class="mdpOublie">
                <a href="../MDP/MDPoublier.php"><strong>Forgot your password</strong></a>
                <!-- Allows access to the forgotten password page -->
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
                    <a href="../Accueil/charte_utilisation.php"><strong>User Charter</strong></a>
                    <!-- Provides access to the terms of use page -->
                </div>
                <div class="droite">
                    <input type="button" onclick="window.location.href ='../Accueil/Aide.php';" value="?"/>
                    <!-- Allows access to the help page -->
                </div>
            </div>
        </div>
    </form>
</div>
</body>
</html>
