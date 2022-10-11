<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>change mdp</title>
</head>
<body>
<form action="New_mdp.php" method="post">
    Identifiant: <input type="text" name="ID"><br>
    Nouveau Mot de Passe <input type="password" name="New_Password_A"><br>
    Confirmer Nouveau Mot de Passe <input type="password" name="New_Password_B"><br>

    <?php
    if(isset($_GET['erreur'])){
        $err = $_GET['erreur'];
        if($err==1){
            echo "<p style='color:red'>le mot de passse a moins de 8 caractères</p>";
        }
        if($err==2){
            echo "<p style='color:red'>le mot de passe et sa confirmation sont diffèrents</p>";
        }
        if($err==3){
            echo "<p style='color:red'> pas de minuscule </p>";
        }
        if($err==4){
            echo "<p style='color:red'> pas de numero </p>";
        }
        if($err==5){
            echo "<p style='color:red'> pas de majusucule </p>";
        }
    }
    ?>

    <br>
    <input type="submit" value="Confirmer">
</form>
</body>
</html>