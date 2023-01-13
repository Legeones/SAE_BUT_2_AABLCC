<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formulaire d'upload de fichiers</title>
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
<form action="upload.php" method="post" enctype="multipart/form-data">

    <h1>Upload Fichier</h1>
    <label for="fileUpload">Fichier:</label>
    <input type="file" name="photo" id="fileUpload">
    <br>
    <br>
    <input id="biolo" type="radio" name="cat" value="Biologie" checked> Biologie
    <input type="radio" name="cat" value="Courriel"> Courriel
    <input type="radio" name="cat" value="Imagerie"> Imagerie
    <br>
    <br>
    <br>
    <br>
    <select name="DPI" id="DPI_Patient">
    <option value="defaut">--Choisir le DPI à modifier--</option>
    <?php
    require ('../BDD/DataBase_DPI.php');
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
    <input class="reche" type="text" id="rech" name="IPPImage" value="<?php $id?>">
    </select>
    <script>
        // Sélectionnez tous les éléments input de type radio
        const radioButtons = document.querySelectorAll('input[type="radio"]');

        // Ajoutez un gestionnaire d'événements "change" à chaque bouton radio
        radioButtons.forEach(button => {
            button.addEventListener('change', event => {
                // Vérifiez si le bouton radio est coché
                if (event.target.checked && event.target.id === "biolo") {
                    document.getElementById('textBio').style.display = "block";
                } else {
                    document.getElementById('textBio').style.display = "none";
                }
            });
        });
    </script>
    <input placeholder="Description de l'image" id="textBio" name="descripBio" type="text" style="display: block">
    <input type="submit" name="submit" value="Upload">
    <p><strong>Note:</strong> Seuls les formats .jpg, .jpeg, .jpeg, .gif, .png sont autorisés jusqu'à une taille maximale de 5 Mo.</p>


    <?php
        if(isset($_GET['erreur'])){
            $err = $_GET['erreur'];
            if($err==1){
                // Affiche une erreur si le format du fichier n'est pas valide
                echo "<p style='color:red'>Erreur : Veuillez sélectionner un format de fichier valide.</p>";
            }
            if($err==2){
                // Affiche une erreur si la taille du fichier est supérieure à la limite autorisée
                echo "<p style='color:red'>Error: La taille du fichier est supérieure à la limite autorisée.</p>";
            }
            if($err==3){
                // Affiche une erreur quand le téléchargement a rencontré un problème
                echo "<p style='color:red'>Error: Il y a eu un problème de téléchargement de votre fichier. Veuillez réessayer.</p>";
            }
            if($err==4){
                // Affiche une erreur
                echo "<p style='color:red'>Error</p>";
            }
            if($err==5){
                // Affiche une erreur quand le fichier existe déjà
                echo "<p style='color:red'>Error: le fichier existe déjà.</p>";
            }
            if($err==6){
                // Affiche une erreur quand l'IPP n'est pas remplis
                echo "<p style='color:red'>Error: L'IPP doit etre remplis</p>";
            }
            if($err==7){
                // Affiche une erreur quand l'IPP n'existe pas
                echo "<p style='color:red'>Error: L'IPP n'existe pas</p>";
            }
        }
        ?>

</form>
</body>
</html>
