<!DOCTYPE html>
<head>
    <meta charset="utf-8" lang="en">
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
    <title> Page des scénarios</title>
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
            <button onclick="location.href='../DPIPatient/DPI.php'">PATIENTS</button>
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button> <!-- Bouton permettant d'accèder aux scenarios -->
        </div>
    </div>
    <div class="droite">
        <div class="bas">
            <form name="form" action="" method="POST">
                <div class="Titreform">
                    <h1><u>Création scenario</u></h1>
                </div>

                <?php

                session_start();


                require('../../Model/BDD/DataBase_Core.php');
                require('../../Model/BDD/Code.php');


                function Connection(): PDO
                {
                    return DataBase_Creator_Unit();
                }

                // Zone de connexion à la base de données
                try {
                $db = Connection();

                ?>

                <div class="choix">
                    <?php
                    $dpi = lst_dpi($db);
                    foreach ($dpi as $val){
                        echo "<input type='checkbox' name='value[]' value={$val['ipp']} /> {$val['nom']} {$val['prenom']}<br/>";
                    }
                    ?>

                    <br><br><br>
                    <div id="date_scenario">
                        <label for="nom_scenario"> Nom du scenario </label> <br> <input type="text" name="nom_scenario" id="nom_scenario"> <br>
                        <!-- Balise indiquant le nom du scénario -->

                        <label for="debut"> début du scénario</label> <br> <input type="date" name="debut" id="debut"> <br>
                        <!-- Balise indiquant le début du scénario -->

                        <label for="fin">fin du scénario</label> <br> <input type="date" name="fin" id="fin">
                        <!-- Balise indiquant la fin du scénario -->

                    </div>
                    <br><br><br>
                    <?php

                    //Main
                    if(!empty($db)) {
                        if (isset($_SESSION['values']) && isset($_SESSION['debut']) && isset($_SESSION['fin'])) {
                            ajout_scenario($db);
                        }

                    }

                    unset($_SESSION['values']);
                    unset($_SESSION['debut']);
                    unset($_SESSION['fin']);

                    //gestion en cas d'exception
                    }catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    } catch (Exception $e) {
                    }

                    ?>

                    <div id="ajout_event">
                        <div id="event_categorie">
                            <label for="nbevent">Nombre d'évènement</label> <br> <input type="text" id="nbevent" name="nbevent" placeholder="Entrez le nombre d'event que vous voulez" style="width: 50%"><br>
                            <!-- Balise demandant à l'utilisateur d'entrer le nom d'événement qu'il souhaite -->
                            <label for="type_categorie">Catégorie des évènements</label> <br> <input type="text" id="type_categorie" name="type_categorie" placeholder="Entrez la catégorie d'évènement que vous souhaitez" style="width: 50%">
                            <!-- Balise demandant à l'utilisateur d'entrer la catégorie d'événements qu'il souhaite -->
                        </div>

                        <div id="event_aleatoire"><br><br>
                            <label for="nbevent_alea">Nombre d'évènement aléatoire</label> <br> <input type="text" id="nbevent_alea" name="nbevent_alea" placeholder="Entrez le nombre d'event que vous voulez" style="width: 50%">
                            <!-- Demande le nombre d'evenement -->
                        </div>
                    </div><br><br>

                    <div align="center" id="stock">

                        <button id="ajout_s" value="Ajout_s" style="position: center">Ajouter le scenario</button>
                        <!-- Bouton permettant d'ajouter un scénario -->
                        <button type="reset" id="reset_s" value="reset_s"> Reset les informations</button>
                        <!-- Bouton permettant d'effacer les informations du scénario -->


                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>