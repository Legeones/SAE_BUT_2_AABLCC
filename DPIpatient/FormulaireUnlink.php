<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire de supression de fichiers</title>
</head>
<body>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="../Images/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='../DPIpatient/DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
            <!-- choix du rôle -->

        </div>
    </div>
    <div class="droite">
        <form action="unlink.php" method="post" enctype="multipart/form-data">

            <h1>Unlink Fichier</h1>
            <br>
            <br>
            <input type="radio" name="catSUPP" value="Biologie" checked> Biologie
            <input type="radio" name="catSUPP" value="Courriel"> Courriel
            <input type="radio" name="catSUPP" value="Imagerie"> Imagerie
            <br>
            <br>
            <input type="text" name="IPPImageSupp" > IPP Patient
            <br>
            <br>
            <input type="text" name="nomImageSupp" > nom Image
            <br>
            <br>
            <input type="submit" name="submit" value="unlink">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                // Affiche une erreur si le nom et l'ipp sont incompatible
                if($err==1){
                    echo "<p style='color:red'>Error: Imcompatibilité entre le nom et l'ipp.</p>";
                }
                // Affiche une erreur si le fichier n'existe pas
                if($err==5){
                    echo "<p style='color:red'>Error: le fichier n'existe pas.</p>";
                }
                // Affiche une erreur si tous les champs ne sont pas remplis
                if($err==6){
                    echo "<p style='color:red'>Error: Tous les champs doivent etre remplis</p>";
                }
                // Affiche une erreur si l'IPP n'existe pas
                if($err==7){
                    echo "<p style='color:red'>Error: L'IPP n'existe pas</p>";
                }
            }
            ?>

        </form>
</body>
</html>