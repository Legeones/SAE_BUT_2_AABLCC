<!DOCTYPE html>
<html lang="fr">
<html>
<head>
    <title>ajout evenement</title>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="../../Images/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='../DPIPatient/DPI.php'">PATIENTS</button>
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div class="droite">
        <form action="../../Controleur/Scenario/gestionEvenement.php" method="post" enctype="multipart/form-data">

            <h1>création evenement</h1>
            <br>
            <br>
            <input type="text" placeholder="Saisir le nom de l'evenement" name="nomEve" />
            <br>
            <br>
            <input type="text" placeholder="Saisir la description de l'evenement" name="desEve" />
            <br>
            <br>
            <select name="DPI" id="DPI_Patient">
                <option value="sans catégorie">--Choisir la categorie ou entrer une nouvelle--</option>
                <?php
                require('../../Model/BDD/DataBase_Scenario.php');
                $der = lstderoulCate();
                while ($row =$der->fetch(PDO::FETCH_ASSOC)) {
                    unset($categorie);
                    $categorie = $row['categorie'];
                    echo "<option value='$categorie'> $categorie </option>";

                }

                ?>
                <script>
                    document.getElementById('DPI_Patient').addEventListener('change',function(){
                        document.getElementById('rech').value = this.value;
                    });
                </script>
                <label for="rech" class="labIPP">Numéro IPP</label>
            </select>
            <input class="reche" type="text" id="rech" name="catEve" value="<?php $categorie?>">
            <br>
            <br>
            <input type="submit" name="submitEvenadd" value="suivant">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1){
                    echo "<p style='color:red'>Error: Imcompatibilité entre le nom et l'ipp.</p>";
                    // Une erreur est affichée lorsqu'il y a une Imcompatibilité entre le nom et l'ipp
                }

                if($err==5){
                    echo "<p style='color:red'>Error: le fichier n'existe pas.</p>";
                    // Une erreur est affichée lorsque le fichier n'existe pas
                }
                if($err==6){
                    echo "<p style='color:red'>Error: Tous les champs doivent etre remplis</p>";
                    // Une erreur est affichée lorsque tous les champs ne sont pas remplis
                }
                if($err==7){
                    echo "<p style='color:red'>Error: L'IPP n'existe pas</p>";
                    // Une erreur est affichée lorsque l'IPP n'existe pas
                }
            }
            ?>

        </form>
</body>
</html>
