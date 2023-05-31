<!DOCTYPE html>
<head>
    <meta charset="utf-8" lang="en">
    <link rel="stylesheet" href="../Simulation.css" media="screen" type="text/css" />
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
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button> <!-- Bouton permettant d'accèder au scenarios -->
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
                require('../../Controleur/Scenario/control_scenario_modif.php');
                require('../../Model/BDD/Code_modification.php');


                function Connection(): PDO
                {
                    return DataBase_Creator_Unit();
                }

                // Zone de connexion à la base de données
                try {
                $db = Connection();

                ?>
                <div class="choix_scenario">
                    <label id="label_id_scenario" style="position: center"> Choix du scenario</label>
                    <select id="selectScenario" name="selectScenario">
                        <option id="id_scenario" value="defaut">--Choisissez votre scenario--</option>
                        <?php
                        list_deroulante_dpi($db);
                        ?>
                    </select>
                    <script defer src="../../Controleur/Scenario/control_scenario_js.js"></script>
                    <?php
                    ?>
                    <br><br>
                    <?php
                    $dpi = lst_dpi($db);
                    foreach ($dpi as $val){
                        echo "<input type='checkbox' name='ipp[]' value={$val['ipp']} /> {$val['nom']} {$val['prenom']}<br/>";
                    }
                    echo "<br>";
                    ?>

                </div>
                <br>
                <div class="choix">

                    <div id="date_scenario">
                        <label for="nom_scenario"> Nom du scenario </label> <br> <input type="text" name="nom_scenario" id="nom_scenario"> <br>
                        <label for="debut"> début du scénario</label> <br> <input type="date" name="debut" id="debut"> <br>
                        <label for="fin">fin du scénario</label> <br> <input type="date" name="fin" id="fin">

                    </div>
                    <br><br><br>
                    <?php

                    //Main
                    if(!empty($db)) {
                        //ajouter la fonction pour la modification des données
                        if(isset($_POST["ipp"])){
                            modification_to_add_dpi($db);
                        }
                    }

                    //gestion en cas d'exception
                    }catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    } catch (Exception $e) {
                    }

                    ?>

                    <div id="ajout_event">
                        <div id="event_categorie" style="background-color: #66CCCC">
                            <label for="nbevent">Nombre d'évènement</label> <br> <input type="text" id="nbevent" name="nbevent" placeholder="Entrez le nombre d'event que vous voulez" style="width: 50%"><br>
                            <label for="type_categorie">Catégorie des évènements</label> <br> <input type="text" id="type_categorie" name="type_categorie" placeholder="Entrez la catégorie d'évènement que vous souhaitez" style="width: 50%">

                        </div>

                        <br><br>

                        <div id="event_aleatoire" style="background-color: mediumpurple">
                            <label for="nbevent_alea">Nombre d'évènement</label> <br> <input type="text" id="nbevent_alea" name="nbevent_alea" placeholder="Entrez le nombre d'event que vous voulez" style="width: 50%">
                        </div>
                    </div>
                    <br><br><br>


                    <div align="center" id="stock">
                        <br><br>
                        <button id="modif_s" value="modif_s" style="position: center">Modifier le scenario</button>
                        <button type="reset_modif_info" id="reset_modif_info" value="reset_modif_info"> Reset les informations</button>


                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
