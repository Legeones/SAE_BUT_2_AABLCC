<!DOCTYPE html>
<head>
    <meta charset="utf-8" lang="en">
    <link rel="stylesheet" href="Simulation.css" media="screen" type="text/css" />
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
            <button onclick="location.href='../DPIpatient/DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button> <!-- Bouton permettant d'accèder au scenarios -->
            <button>JSAISPAS</button>
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


                require ('../BDD/DataBase_Core.php');
                require ('../Partie_Scenario/Code.php');

                function Connection(): PDO
                {
                    return DataBase_Creator_Unit();
                }

                // Zone de connexion à la base de données
                try {
                $db = Connection();

                ?>

                <div class="choix">
                    <select id="selectDPI" name="selectDPI">
                        <option id="ipp" value="defaut">--Choisissez votre DPI--</option>
                        <?php

                        //liste déroulante pour afficher les patients
                        $recuppatient= $db->prepare('select ipp,nom, prenom from Patient');
                        $recuppatient->execute();
                        while ($row = $recuppatient->fetch(PDO::FETCH_ASSOC)) {
                            unset($id, $nom, $prenom);
                            $id = $row['ipp'];
                            $nom = $row['nom'];
                            $prenom = $row['prenom'];
                            echo "<option value='$id'> $nom $prenom </option>";

                        }

                        ?>
                        <!-- zone de récupération des patients-->
                        <input name="valueipp" id="valueipp">
                        <input name="nomipp" id="nomipp">
                    </select>

                    <script>
                        //fonction pour récupérer les données des patients
                        document.getElementById('selectDPI').addEventListener('change',function(){
                            document.getElementById('valueipp').value = this.value;
                            document.getElementById('nomipp').value = this.options[this.selectedIndex].textContent;});
                    </script>

                    <br><br><br>
                    <div id="date_scenario">
                        <label for="nom_scenario"> Nom du scenario </label> <br> <input type="text" name="nom_scenario" id="nom_scenario"> <br>
                        <label for="debut"> début du scénario</label> <br> <input type="date" name="debut" id="debut"> <br>
                        <label for="fin">fin du scénario</label> <br> <input type="date" name="fin" id="fin">

                    </div>
                    <br><br><br>
                    <?php

                    //Main
                    if(!empty($db)) {
                        if (!empty($_SESSION['val']) && !empty($_SESSION['debut']) && !empty($_SESSION['fin'])) {
                            ajout_scenario($db);
                            echo "<P style='color: green'>l'ajout a été effectué</p>";
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
                        <button id="ajout_s" value="Ajout_s" style="position: center">Ajouter le scenario</button>
                        <button type="reset" id="reset_s" value="reset_s"> Reset les informations</button>


                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>