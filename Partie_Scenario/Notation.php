
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
                    // Zone de connexion à la base de données
                $db_username = 'postgres';
                $db_password = 'steven59330';
                $db_name = 'postgres';
                $db_host = 'localhost';

                $db = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
                echo 'Connexion réussie';

                ?>
                <div class="btnchoix" >
                        <?php
                        //partie pour choisir le scénario
                        echo "<div class= choix>";
                        echo "<p id='textDPI'> le texte pour le DPI</p>";
                        ?>
                        <select id='selectDPI' name='selectDPI'>
                            <option value="defaut"> --Sélectionner un DPI--</option>
                            <?php
                            //récupération des données pour les options
                            $recuppatient = $db->prepare('select ipp,nom, prenom from Patient');
                            $recuppatient->execute();
                            while ($row = $recuppatient->fetch(PDO::FETCH_ASSOC)) {
                                unset($id, $nom, $prenom);
                                $id = $row['ipp'];
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                echo "<option value='$id'> $nom $prenom </option>";

                            }
                            ?>

                        </select>

                    <?php
                            echo "<p id='textEtu'> le texte pour les étudiants</p>";

                            echo "<select id='selectEtu' name='selecEtu'>";

                            $requete2 = $db->prepare("select login,email
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
                    <input type="text" name="textArea" placeholder="Entrez vos remarques">
                </div>


            </form>
        </div>
    </div>
</body>
</html>
