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
    ?>

    <form action="test_etu_prof.php" method="post">
        <br>
        <input type="submit" value="passer en mode etu">

</div>
</body>
</html>