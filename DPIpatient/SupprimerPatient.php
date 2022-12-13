<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Zone de connexion -->

    <meta charset="UTF-8">
    <title>Supprimer Patient</title>
</head>
<body>
<form action="ConfirSupp.php" method="post">
    <select name="DPI" id="DPI_Patient">
        <option value="defaut">--Choisir le DPI à modifier--</option>
        <?php
        require ('../BDD/DataBase_Core.php');
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
        <input class="reche" type="text" id="rech" name="IPP_SUPP" value="<?php $id?>">
    </select>

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
}


?>
