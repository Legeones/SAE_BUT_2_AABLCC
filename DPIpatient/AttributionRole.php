<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>change mdp</title>
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header id="haut">
    <img class="logo" src="../Images/logoIFSI.png" alt="LogoIFSI">
    <button title="Déconnexion" id="logout" onclick="location.href='../Connexion/Deconnexion.php'"><img id="img_logout" src="../Images/Logout.png"></button>
</header>
<div class="global">
    <div id="gauche" class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg" alt="Profile">
        </div>
        <div class="btn-group">
            <button onclick="location.href='../DPIpatient/DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div id="droit" class="droite">
        <form action="AttributionRoleSQL.php" method="post">
            Identifiant: <input type="text" name="ID"><br>
            Role <input type="text" name="Role"><br>
            <!-- zone de gestion des erreurs -->

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
            // Ici une erreur est affichée si le login est invalide
                if($err==1){
                    echo "<p style='color:red'> le login est invalide </p>";
                }
            // Ici une erreur est affichée si tous les champs ne sont pas remplis
                if($err==2){
                    echo "<p style='color:red'> les champs doivent etre remplis </p>";
                }

            }
            ?>

            <br>
            <input type="submit" value="Confirmer">
        </form>
    </div>
</body>