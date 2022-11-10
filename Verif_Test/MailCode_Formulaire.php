<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Importation des fichiers de style -->

    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Verif_Test/CSS.css" media="screen" type="text/css" />
    <title>Inscription</title>
</head>
<body id="general">
<!-- Zone de connexion -->

<form action="Verification_KeyCode.php" method="post">
    <h1>Inscription</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="Groupe">
            <script>
                var a = document.createElement('a');
                a.href = window.location.replace='../Verif_Test/MailCode_Formulaire.php?after=3';
                var lien = document.createTextNode("Vous n'avez pas reçu le code ?");
                a.appendChild(lien);
                document.body.appendChild(a);
            </script>
            <label> Saisissez le code de validation reçu par mail : </label>
            <input type="text" placeholder="Saisir votre code" name="Key" />
        </div>
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Valider">
        </div>
        <!-- Gestion des erreurs -->

        <?php
        if(isset($_GET['after']))
        {   
            $aft = $_GET['after'];
            // if($aft==0)
            // { header('Location: ../Connexion/Login.php'); }
            if($aft==1)
            { echo "<p style='color:red'>Votre Code a expiré</p>"; }
            if($aft==2)
            { echo "<p style='color:red'>Code Invalide</p>"; }
            if($aft==3)
            {   
                require('../Verif_Test/Mail.php');
                Resend();
                echo "<p style='color:red'>Code renvoyé</p>";
            }
        }
        ?>
        
    </div>
</form>
</body>
</html>
