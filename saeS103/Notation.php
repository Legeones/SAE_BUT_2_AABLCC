
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
                    <h1><u>Création simulation</u></h1>
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

                ?>
                <div class="btnchoix" >
                        <?php

                        echo "<div class= choix>";
                        echo "<p id='textDPI'> le texte pour le DPI</p>";
                        ?>
                        <select id='selectDPI' name='selectDPI'>
                            <option value="defaut"> --Sélectionner un DPI--</option>
                            <?php
                            $requete = $dbh->prepare("select IPP,nom
                            from patient ");
                            $requete->execute();

                            while ($row = $requete->fetch(PDO::FETCH_ASSOC)){

                            unset($id, $name);
                            $id = $row['IPP'];
                            $name = $row['nom'];
                            echo '<option value="'.$id.'">'.$name.'</option>';
                            }
                            ?>


                            <?php

                            function takeID($dbh){
                            $take = $dbh->prepare('select max(idsimu)from simulation');
                            $take->execute();
                            foreach ($take as $first){
                            $firstID = $first[0]+1;
                            }
                            return $firstID;
                            }

                            function takeCD($dbh){
                            $take = $dbh->prepare('select current_date');
                            $take->execute();
                            foreach ($take as $date){
                            $current = $date[0];
                            }
                            return $current;
                            }


                            $req = $dbh->prepare("insert into Simulation (idSimu, motCle, ipp, creation) values (?, ?, ?, ?)");

                            $idsimu = takeID($dbh);
                            $date = takeCD($dbh);
                            $req->bindParam(1, $idsimu);
                            $req->bindParam(2, $motC);
                            $req->bindParam(3, $dpi);
                            $req->bindParam(4, $date);
                            $req->execute();
                            ?>

                        </select>

                    <?php
                            echo "<p id='textEtu'> le texte pour les étudiants</p>";

                            echo "<select id='selectEtu'>";

                            $requete2 = $dbh->prepare("select login,email
                            from utilisateur where role='etudiant'");
                            $requete2->execute();


                            while ($row2 = $requete2->fetch(PDO::FETCH_ASSOC)){
                                unset($id2, $login);
                                $id2 = $row2['email'];
                                $login = $row2['login'];
                                echo '"<option value="'.$id2.'">'.$login.'</option>';
                            }
                            echo "</select>";
                            echo "</div>";


                        }catch (PDOException $e){
                            echo 'Erreur : ' . $e->getMessage();}

                        $conn= null;

                        ?>


                </div>

                <script type="text/javascript">

                </script>

                <br>

                <div class="textArea">
                    <br>
                    <input type="text" name="textArea" placeholder="Entrez votre scénario">
                </div>

                <br>

                <div class="valider/resetSimulation">
                    <button type="submit" name="valideSimu"> Créer la simulation</button>
                    <button type="reset" name="resetSimu"> Reset les infos</button>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
