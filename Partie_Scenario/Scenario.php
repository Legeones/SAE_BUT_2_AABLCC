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
            <button>SCENARIOS</button> <!-- Bouton permettant d'accèder au scenarios -->
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
                require ('../Partie_Scenario/Code_php.php');

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
                        <input name="valueipp" id="valueipp">
                        <input name="nomipp" id="nomipp">
                    </select>

                    <script>
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

                    //fonction qui permet d'avoir la liste des id
                    function id_existance($dbh){
                        $req = $dbh->prepare("select idevenement
                        from evenement");
                        $req->execute();
                        $donnees = array();
                        foreach ($req as $r){
                            $donnees[] = $r;

                        }
                        return $donnees;
                    }

                    function search_idscenario($db)
                    {
                        $src = $db->prepare("select max(idscenario)
                        from scenario");
                        $src->execute();
                        $donnees = array();
                        foreach ($src as $row){
                            $donnees += $row;
                        }
                        return $donnees[0] + 1;
                    }


                    function recup_event_id($dbh): array
                    {
                        $req = $dbh->prepare("select min(idevenement), max(idevenement) from evenement");
                        $req->execute();
                        $infos = array();
                        foreach ($req as $row){
                            $infos[] = $row;
                        }
                        return $infos;
                    }

                    function ajout_scenario($dbh): void
                    {
                        $idscenario = search_idscenario($dbh);
                        $idevents = recup_event($dbh);
                        //insertion des données dans la table scenario
                        $insertion = $dbh->prepare("insert into scenario (idscenario,nom, debut, fin, nbEv, createur) 
                        VALUES (?,?,?,?,?,?)");

                        $insertion->bindparam(1, $idscenario);
                        $insertion->bindparam(2, $_POST['nom_scenario']);
                        $insertion->bindparam(3, $_SESSION['debut']);
                        $insertion->bindparam(4, $_SESSION['fin']);
                        $insertion->bindparam(5, $_POST['nbevent']);
                        $insertion->bindparam(6, $_SESSION['username']);
                        $insertion->execute();
                        for($i=0; $i < $_POST['nbevent']; $i++){
                            $k = random_int(0, sizeof($idevents));
                            $id = $idevents[$i];
                            $insertion_event = $dbh->prepare("insert into scenarioevenement (idscenario, idevenement) VALUES (?,?)");
                            $insertion_event->bindparam(1, $idscenario);
                            $insertion_event->bindparam(2, $id);
                            $insertion_event->execute();
                        }




                    }

                    function search_idevent($db)
                    {
                        $src = $db->prepare("select max(idevenement)
                        from evenement");
                        $src->execute();
                        $donnees = array();
                        foreach ($src as $row){
                            $donnees += $row;
                        }
                        return $donnees[0] + 1;
                    }

                    function hdeclenchement(): int
                    {
                        return rand(0,23);
                    }



                    function suppression_doublons_scenario($dbh): string
                    {
                        $vue = $dbh->prepare("
                        select idscenario, row_number() over (partition by debut, fin, dpi order by debut, fin, dpi) as rn
                        from scenario");
                        $res = $vue->execute();
                        $requete = $dbh->prepare("
                        delete
                        from scenario
                        using ?
                        where ? = scenario.idscenario and ? > 1");
                        $requete->bindparam(1, $res);
                        $requete->bindparam(2, $res);
                        $requete->bindparam(3, $res);
                        $requete->execute();
                        return "";
                    }

                    //fonction qui recup les id min et max




                    //fonction qui permet de recup les events en fonction de leur id
                    function recup_event($dbh){
                        $i = $_SESSION['nb_event'];
                        $k= 0;

                        //print_r(recup_event_id($dbh));
                        $donnees = recup_event_id($dbh);
                        $les_ids= id_existance($dbh);
                        $events = array();
                        print_r($les_ids);
                        print_r($donnees);
                        while ($k != $i){
                            $r = random_int($donnees[0][0], $donnees[0][1]);
                            if ( in_array($r, $les_ids[$k])){
                                $events[] = $r;
                                $k += 1;
                            }
                        }
                        return $events;
                    }

                    //creer fonction pour ajout des events et des scenarios
                    //ajouter l'utilisateur pour les scenarios
                    //relier les pages pour la recup
                    //recup les donnees sur discord(jeu de test scenario)

                    if(!empty($db)) {
                        //print_r(recup_event_id($db));
                        //print_r(recup_event($db));
                        if (!empty($_SESSION['val']) && !empty($_SESSION['debut']) && !empty($_SESSION['fin'])) {
                            ajout_scenario($db);
                            echo "<P style='color: green'>l'ajout a été effectué</p>";
                        }

                    }






                    }catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    }

                    ?>
                    <!--
                    <script type="text/javascript">


                    let i = 0;
                    let contenu = "";

                    function nouveauInput(){
                        i = i + 1;
                        contenu = contenu + "<label for='event" + i + "'>Evenement "+ i +" <input type='text' id='event" + i + "' /><br /> ";
                        document.getElementById('auto').innerHTML = contenu;
                    }

                    function event_aleatoire(min, max){
                        let k=0;
                        let i=0
                        let n = document.getElementById('nbevent');
                        let list = [];
                        while (k < n){
                            let r = Math.floor(Math.random() * (max-min))+min;
                            list.push(r);
                            //ajouter l'event correspondant au numéro des variables
                        }
                        while (i < list.length){
                            contenu = contenu + list[i];
                        }
                        document.getElementById('auto').innerHTML = contenu;
                    }

                    function supprimerInput() {
                        const e = document.getElementById("event");
                        let child = e.lastElementChild;
                        while (child) {
                            e.removeChild(child);
                            child = e.lastElementChild;
                        }
                    }

                    const btn = document.getElementById(
                        "btn").onclick = function () {
                        supprimerInput();
                    };

                    </script>
                    -->

                    <div id="ajout_event">
                        <input type="text" id="nbevent" name="nbevent" placeholder="Entrez le nombre d'event que vous voulez" style="width: 50%">
                        <input type="button" id="btn" value="Reset les informations" onclick="window.location.reload()" >
                    </div>
                    <br><br><br>

                        <!--<button type="button" onclick="nouveauInput()">Ajouter un évènement</button>-->

                    <div id="auto">
                        <!-- partie pour les ajouts auto des inputs des events-->
                    </div>



                    <div align="center" id="stock">
                        <br><br>
                        <button id="ajout_s" value="Ajout_s" style="position: center">Ajouter le scenario</button>
                        <button type="reset" id="reset_s" value="reset_s"> Reset les informations</button>
                        <?php
                        ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>