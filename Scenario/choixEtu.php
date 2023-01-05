<!DOCTYPE html>
<html lang="fr">
<html>
<head>
    <title>choix etudiant</title>
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
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <form action="res.php" method="post" enctype="multipart/form-data">

            <h1>choix etu</h1>
            <br>
            <br>
                <?php
                require ('../BDD/DataBase_Scenario.php');
                session_start();
                $der = lstderoulanteEtu($_SESSION['IdScenario']);
                foreach ($der as $val){
                    echo "<input type='checkbox' name='gout[]' value={$val['login']} /> {$val['nom']} {$val['prenom']}<br/>";
                }

                ?>
            <br>
            <br>
            <input type="submit" name="submit" value="suivant">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];
                if($err==1){
                    echo "<p style='color:red'>Error: Imcompatibilité entre le nom et l'ipp.</p>";
                    // Affiche une erreur s'il y a une imcompatibilité entre le nom et l'ipp
                }

                if($err==5){
                    echo "<p style='color:red'>Error: le fichier n'existe pas.</p>";
                    // Affiche une erreur si le fichier n'existe pas
                }
                if($err==6){
                    echo "<p style='color:red'>Error: Tous les champs doivent etre remplis</p>";
                    // Affiche une erreur si tous les champs ne sont pas remplis
                }
                if($err==7){
                    echo "<p style='color:red'>Error: L'IPP n'existe pas</p>";
                    // Affiche une erreur si l'IPP n'existe pas
                }
            }
            ?>

        </form>
</body>
</html>