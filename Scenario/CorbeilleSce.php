<!DOCTYPE html>
<html lang="fr">
<html>
<head>
    <title>Corbeille Scenario</title>
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
        </div>
    </div>
    <div class="droite">
        <form action="CorbeilleSceSQl.php" method="post" enctype="multipart/form-data">

            <h1>choix scenario</h1>
            <br>
            <br>
            <?php
            require ('../BDD/DataBase_Scenario.php');
            $der = lstderoulanteScenario();
            foreach ($der as $val){
                echo "<input type='radio' name='Corscenario' checked value={$val['idscenario']} /> {$val['nom']}<br/>";
            }

            ?>
            <br>

            <br>
            <input type="submit" name="submit" value="suivant">

            <?php
            if(isset($_GET['erreur'])){
                $err = $_GET['erreur'];

                if($err==7){
                    echo "<p style='color:red'>Error: Le scenario n'existe pas</p>";
                }
            }
            ?>

        </form>
</body>
</html>