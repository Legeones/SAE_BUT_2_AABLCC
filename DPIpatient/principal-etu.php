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
    echo "Bonjour $user, tu es un(e) étudiant(e)";
    ?>

</div>
</body>
</html>