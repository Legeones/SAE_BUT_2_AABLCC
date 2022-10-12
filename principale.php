<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="style2.css" media="screen" type="text/css" />
</head>
<body style='background:#fff;'>
<div id="content">
    <!-- tester si l'utilisateur est connecté -->
    <?php
    session_start();
    $user = $_SESSION['username'];
    echo "Bonjour $user, vous êtes connecté";
    echo '<br>';
    if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof") {echo '<a href="transition.php"><input type="button" value="passer en mode etu" /></a>';}
    echo '<br>';
    if ($_SESSION["Role"] == "admin") {echo '<a href="AttributionRole.php"><input type="button" value="attribuer role" /></a>';}
    echo '<br>';
    if ($_SESSION["Role"] == "pseudo-etu") {echo '<a href="RetourMode.php"><input type="button" value="retour mode prof" /></a>';}
    ?>
    <form action="DPI.php" method="post">
        <br>
        <input type="submit" value="DPI">


</div>
</body>
</html>

