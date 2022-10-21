<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Inscription/InscriptionCSS.css" media="screen" type="text/css" />
    <title>Inscription</title>
</head>
<body>
<form action="Verification_KeyCode.php" method="post">
    <h1>Inscription</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="Groupe">
            <script>
                var a = document.createElement('a');
                a.href = window.location.replace='Aide.php';
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
        }
        ?>
        
    </div>
</form>
</body>
</html>
