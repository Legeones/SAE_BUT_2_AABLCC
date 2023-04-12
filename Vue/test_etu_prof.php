<html>
<head>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="style2.css" media="screen" type="text/css" /> // CSS obselte
</head>
<body style='background:#fff;'>
<div id="content">
    <!-- permet de tester si l'utilisateur est connecté -->
    <?php
    session_start();
    $user = $_SESSION['username'];
    echo "Bonjour $user, ici vous pouvez testez le mode etu ";
    ?>

    <form action="DPI.php" method="post">
        <br>
        <input type="submit" value="retour en mode prof">

</div>
</body>
</html>
