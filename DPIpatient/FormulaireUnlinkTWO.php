<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Formulaire de supression de fichiers</title>
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
        </div>
    </div>
    <div class="droite">
        <form action="unlink.php" method="post" enctype="multipart/form-data">

            <h1>Unlink Fichier</h1>
            <br>
            <br>
            <select name="DPI" id="DPI_Patient">
                <option selected="selected">Sélectionner une valeur</option>
                <?php
                session_start();
                require  ('../DPIpatient/RecupInfoBDD_AjouterDPI.php');
                if($_SESSION['catSUPP']=='Biologie'){
                    $langages = lstderoulanteImageBio($_SESSION['IPPImageSupp']);
                }
               elseif ($_SESSION['catSUPP']=='Courriel'){
                   $langages = lstderoulanteImageCou($_SESSION['IPPImageSupp']);
               }
                else{
                    $langages = lstderoulanteImageRad($_SESSION['IPPImageSupp']);
                }

                // Parcourir le tableau
                foreach($langages as $value){
                    ?>
                    <option value="<?php echo strtolower($value); ?>"><?php echo $value; ?></option>
                    <?php
                }
                ?>
                <script>
                    document.getElementById('DPI_Patient').addEventListener('change',function(){
                        document.getElementById('rech').value = this.value;
                    });
                </script>
                <input class="reche" type="text" id="rech" name="nomImageSupp" value="<?php $value?>">
            </select>
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