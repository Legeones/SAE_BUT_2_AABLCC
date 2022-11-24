<?php
session_start();
require ("RecupInfoBDD_AjouterDPI.php");
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <!-- Ajout du logo -->
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
    <!-- zone de connexion -->
    <div class="droite">
        <div class="bas">


            <script>
                function suivant(div1, div2){
                    var defaut = document.getElementById(div1);
                    var autre = document.getElementById(div2)
                    defaut.style.display = 'none';
                    autre.style.display = 'block';
                }

                function suivantCourt (div1, div2){
                    var defaut = document.getElementById(div1);
                    var autre = document.getElementById(div2);
                    if (defaut.style.display == 'none'){
                        if (autre.style.display == 'block'){
                            autre.style.display = 'none';
                        }
                        defaut.style.display = 'block';
                    }
                }
                function changeCouleurBouton(b1,b2) {
                    var bouton = document.getElementById(b1);
                    var bouton1 = document.getElementById(b2);
                    if (bouton.style.background = '#66CCCC'){
                        bouton.style.background = 'red';
                        bouton1.style.background = '#66CCCC';
                    }


                }

            </script>


            <div class="lesForms">
                <button id="boutondebut" style="background-color:red" onclick="suivantCourt('formMDF','formINFO'), changeCouleurBouton('boutondebut','boutondebut1')">Recherche DPI</button>
                <button id="boutondebut1" style="background-color:#66CCCC" onclick="suivantCourt('formINFO','formMDF'), changeCouleurBouton('boutondebut1','boutondebut')">Modification</button>

            </div>
            <form id="form" action="MDPDPI_PHP.php" method="post">
                <div class="recherche">
                    <div class="contenuRech">
                        <select name="DPI" id="DPI_Patient">
                            <option value="defaut">--Choisir le DPI à modifier--</option>
                            <?php
                            $der = lstderoulante();
                            while ($row =$der->fetch(PDO::FETCH_ASSOC)) {
                                unset($id, $nom, $prenom);
                                $id = $row['ipp'];
                                $nom = $row['nom'];
                                $prenom = $row['prenom'];
                                echo "<option value='$id'> $nom $prenom </option>";

                            }

                            ?>
                            <script>
                                document.getElementById('DPI_Patient').addEventListener('change',function(){
                                    document.getElementById('rech').value = this.value;
                                });
                            </script>
                            <label for="rech" class="labIPP">Numéro IPP</label>
                            <input class="reche" type="text" id="rech" name="recherche" value="<?php $id?>">
                            <input type="submit" value="Recherche">
                        </select>
                    </div>
                </div>
                <div class="separation"></div>
                <div id="formMDF" style="display: block">
                    <div class="Titreform">
                        <h1><u>Modifier un DPI</u></h1>
                    </div>

                    <?php

                    $lst = nameColonne()[0];
                    $lst1 = nameColonne()[1];
                    for ($i = 2 ; $i<sizeof($lst) ; $i++):?> <!-- le 2 evite de prendre l'ipp et iep-->
                    <?php
                    $res = "$lst[$i]";
                    if ($i == 17 ) {$i += 1;}
                    if ($i == 18) {$i+=1;}
                    $type = "$lst1[$i]";
                    $res2 = 'val' . $i;
                    if ($type == 'integer' || $type == 'double precision'){$type = "number";}
                    else if ($type == 'timestamp without time zone'){$type = "date";}
                    if ($i >= 25 ):?>
                    <div class="Groupe1">
                        <?php echo "<label for='$res'> $lst[$i]: </label><br>";
                        $type = "radio"?>
                        <div class="Boolean">
                            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="1" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 1):?> checked <?php endif ?>/>
                            <?php echo "<label for='$res'>Autonome</label>"?>
                            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="2" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 2):?> checked <?php endif ?>/>
                            <?php echo "<label for='$res'>Aide Partielle</label>"?>
                            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="3" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 3):?> checked <?php endif ?>/>
                            <?php echo "<label for='$res'>Aide Totale</label>"?>
                        </div>
                    </div>
                    <?php endif;

                    if ($i < 25 && $i >20 || $i<19):?>
                    <div class="Groupe">
                        <?php echo "<label for='$res'> $lst[$i]: </label><br>"; ?>
                        <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="<?= $_SESSION[$res2] ?? '' ?>"/>
                    </div>
                    <?php endif;

                    if ($i == 19 || $i == 20):?>
                    <div class="Groupe1">
                        <?php echo "<label for='$res'> $lst[$i]: </label><br>";
                        $type = "radio"?>
                        <div class="Boolean">
                            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="true" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == "false"):?> checked <?php endif ?>/>
                            <?php echo "<label for='$res'>OUI</label>"?>
                            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="false" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] != "false"):?> checked <?php endif ?>/>
                            <?php echo "<label for='$res'>NON</label>";?>

                        </div>
                    </div>
                    <?php endif;
                    $_SESSION[$res2] = null;
                    ?>
                    <?php endfor;?>
                    <div class="modif" align="center">
                        <br>
                        <input onclick="" type="submit" value="Modifier" >
                    </div>
                    <div id="formINFO" style="display: none">
                    </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
}