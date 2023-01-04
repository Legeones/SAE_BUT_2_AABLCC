
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Simulation.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='principale.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <form action="" method="post">
            <input name="recherche_barre">
            <select name="select">
            </select>
            <button type="submit">Rechercher</button>
            <button name="next">Next</button>
            <button name="back">Back</button>
        </form>

        <div class="bas">
            <form name="form" action="Code.php" method="POST">
                <div class="Titreform">
                    <h1><u>Création scenario</u></h1>
                </div>
                <?php
                session_start();
                require ("Code.php");
                try{
                $db_username = 'postgres';
                $db_password = 'steven59330';
                $db_name = 'postgres';
                $db_host = 'localhost';

                $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
                echo 'Connexion réussie';




                }catch (PDOException $e){
                    echo 'Erreur : ' . $e->getMessage();}

                    $conn= null;

                ?>


            </form>
        </div>
    </div>
</body>
</html>

