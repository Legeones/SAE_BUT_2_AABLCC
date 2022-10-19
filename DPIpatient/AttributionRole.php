<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>change mdp</title>
</head>
<body>
<form action="AttributionRoleSQL.php" method="post">
    Identifiant: <input type="text" name="ID"><br>
    Role <input type="text" name="Role"><br>
    <!-- zone de gestion des erreurs -->

    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];

        if($err==1){
            echo "<p style='color:red'> le login est invalide </p>";
        }

        if($err==2){
            echo "<p style='color:red'> les champs doivent etre remplis </p>";
        }

    }
    ?>

    <br>
    <input type="submit" value="Confirmer">