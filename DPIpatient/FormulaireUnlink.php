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
            <select name="DPI" id="DPI_Patient">
                <option value="defaut">--Choisir le DPI--</option>
                <?php
                require ('../DPIpatient/RecupInfoBDD_AjouterDPI.php');
                $der = lstderoulante();
                while ($row =$der->fetch(PDO::FETCH_ASSOC)) {
                    unset($id, $nom, $prenom);
                    $id = $row['ipp'];
                    $nom = $row['nom'];
                    $prenom = $row['prenom'];
                    echo "<option value='$id'> $nom $prenom </option>";

                }

                ?>
                <script>
                    document.getElementById('DPI_Patient').addEventListener('change',function(){
                        document.getElementById('rech').value = this.value;
                    });
                </script>
                <label for="rech" class="labIPP">Numéro IPP</label>
                <input class="reche" type="text" id="rech" name="IPPImageSupp" value="<?php $id?>">
            </select>
            <br>
            <br>
            <input type="text" name="nomImageSupp" > nom Image
            <br>
            <br>
            <input type="submit" name="submit" value="unlink">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1){
                    echo "<p style='color:red'>Error: Imcompatibilité entre le nom et l'ipp.</p>";
                }

                if($err==5){
                    echo "<p style='color:red'>Error: le fichier n'existe pas.</p>";
                }
                if($err==6){
                    echo "<p style='color:red'>Error: Tous les champs doivent etre remplis</p>";
                }
                if($err==7){
                    echo "<p style='color:red'>Error: L'IPP n'existe pas</p>";
                }
            }
            ?>

        </form>
</body>
</html>