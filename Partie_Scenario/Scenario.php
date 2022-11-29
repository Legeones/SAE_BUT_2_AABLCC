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

                require ('Code.php');

                    // Zone de connexion à la base de données
                try {
                    $db_username = 'postgres';
                    $db_password = 'steven59330';
                    $db_name = 'postgres';
                    $db_host = 'localhost';
                    $db = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");

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
                    <?php



                    }catch (PDOException $e) {
                        echo 'Erreur : ' . $e->getMessage();
                    }

                    ?>

                    <button id="selectDPI" value="valider"> Valider</button>
                    <div id="stock">
                        <?php

                        if(isset($_SESSION['val'])) {
                            if (isset($db)) {
                                creation_input($db);
                            }
                        }
                        unset($_SESSION['val']);
                        ?>

                        <button id="ajoutScenario" value="Ajout_s" style="position: center">Ajouter le scenario</button>
                        <?php

                        ?>

                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>