<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="InscriptionCSS.css" media="screen" type="text/css" />
    <title>Inscription</title>
</head>
<body>
<form action="Verification_KeyCode.php" method="post">
    <h1>Inscription</h1>
    <div class="Separation"></div>
    <div class="Formulaire">
        <div class="Groupe">
            <label> Code recu par mail Via l'adresse ??? : </label>
            <input type="text" placeholder="Saisir votre code" name="Key" />
        </div>
    </div>
    <div class="piedDePage">
        <div class="Validation" align="center" >
            <input type="submit" value="Valider Code">
        </div>
        
        <?php
        if(isset($_GET['after']))
        {   
            $aft = $_GET['after'];
            if($aft==0)
            { header('Location: Login.php'); }
            if($aft==1)
            { echo "<p style='color:red'>Code Invalide</p>"; }
        }
        ?>
        
    </div>
</form>
</body>
</html>