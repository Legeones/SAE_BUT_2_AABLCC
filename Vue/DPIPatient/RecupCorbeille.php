<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Zone de connexion -->

    <meta charset="UTF-8">
    <title>Recuperation Patient</title>
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header id="haut">
    <img class="logo" src="../../Images/logoIFSI.png" alt="LogoIFSI">
    <button title="Déconnexion" id="logout" onclick="location.href='../../Controleur/Accueil/Deconnexion.php'"><img id="img_logout" src="../../Images/Logout.png"></button>
</header>
<div class="global">
    <div id="gauche" class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg" alt="Profile">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div id="droit" class="droite">
            <form action="../../Controleur/DPIPatient/RecupCorbeilleSQL.php" method="post">
                <select name="DPI" id="DPI_Patient">
                    <option value="defaut">--Choisir le DPI à modifier--</option>
                    <?php
                    require('../BDD/DataBase_Dpi.php');
                    $der = lstderoulanteCorb();
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
                </select>
                <input class="reche" type="text" id="rech" name="IPP_Recup" value="<?php $id?>">
                <br>
                <input  type="submit" value="Confirmer" name="Confirmer" id="Confirmer">
            </form>
        <!-- gestion des erreurs -->

<?php
if (isset($_GET['erreur'])) {
    $err = $_GET['erreur'];
    if ($err == 1) {
        echo "<p style='color:red'>tous les champs doivent etre remplis</p>";
        //Ici une erreur est affiché si tous les champs ne sont pas remplis

    }
    if ($err == 2) {
        echo "<p style='color:red'>IPP n'est pas dans la corbeille</p>";
        // Ici une erreur est affiché si IPP n'est pas dans la BBD
    }
    if ($err == 3) {
        echo "<p style='color:red'>IPP ne doit pas avoir de lettre</p>";
        // Ici une erreur est affiché si IPP contient des lettres
    }
} ?>
        </div>
    </div>
</body>


