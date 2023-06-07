<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" lang="en">
    <link rel="stylesheet" href="../Scenario/LogPatient.css" media="screen" type="text/css" />
    <title>Visualisation des logs patients</title>
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
        <div class="btn-group"></div>
    </div>
    <div class="droite">
        <div class="bas">
            <form name="form" action="" method="GET">
                <div class="Titreform">
                    <h1><u>Visualisation des logs patients</u></h1>
                </div>

                <?php

                session_start();


                require('../../Model/BDD/DataBase_Core.php');

                function Connection(): PDO
                {
                    return DataBase_Creator_Unit();
                }

                // Zone de connexion à la base de données
                try {
                $db = Connection();

                ?>

                <div class="choix_recherche">
                    <div id="research_items">
                        <label for="nom_scenario"> Nom du scenario </label> <br> <input type="text" name="nom_scenario" id="nom_scenario"> <br><br>
                        <label for="nom_etudiant"> Nom de l'étudiant </label> <br> <input type="text" name="nom_etudiant" id="nom_etudiant"> <br>
                        <ul id="tab_datas"></ul>
                    </div>
                    <br><br><br>
                    <?php

                    //gestion en cas d'exception
                    }catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    } catch (Exception $e) {
                    }

                    ?>
                </div>
                <br><br><br>
                <div class="choix_recherche" style="position: center" id="validation">
                    <br><br>
                    <button id="rechercher_s" value="rechercher_s" style="position: center">Rechercher</button>
                    <button type="reset" id="reset_recherche" value="reset_recherche"> Reset les informations</button>
                </div>
            </form>
        </div>
    </div>
    <script defer src="/Model/BDD/Code_log_patient.js"
</body>
</html>