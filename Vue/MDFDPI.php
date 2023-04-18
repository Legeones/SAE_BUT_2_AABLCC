<?php
session_start();
require('Principal_PHP_Fonction_DPI_ADD_or_Modif.php');
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS_DPI.css" media="screen" type="text/css" />
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
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='principaleEve.php'">SCENARIOS</button>

        </div>
    </div>
    <!-- zone de connexion -->
    <div class="droite">
        <div class="bas">
            <br>
            <form id="form" action="../Controleur/MDPDPI_PHP.php" method="post">
                <div class="recherche">
                    <div class="contenuRech">
                        <?php deroulementDPI(); ?>
                        <input class="reset" onclick="location.href='MDF_Accueil.php'" type="button" value="Retour"/>
                    </div>
                </div>
                <div class="separation"></div>
                <div id="formMDF">
                    <div class="Titreform">
                        <h1><u>Modifier un DPI</u></h1>
                    </div>
                    <?php

                    $_SESSION['table'] = 'patient';
                    $lst = nameColonne('patient')[0];
                    $lst1 = nameColonne('patient')[1];
                    $debut = 1;
                    $fin = sizeof($lst);
                    $_SESSION['Debut'] = $debut;
                    $_SESSION['Fin'] = $fin;
                    for ($i = $debut; $i < $fin; $i++) {
                        if ($i == 17){$i +=1;}
                        if ($i == 18){$i +=1;}
                        $type = "$lst1[$i]";
                        $res2 = 'val' . $i;
                        $res = "$lst[$i]";
                        if ($type == 'integer' || $type == 'double precision') {$type = "number";}
                        if ($i <= 16 or $i >= 21 and $i<=24){formulaire($res, $lst, $i, $type, $res2);}
                        elseif ($i >=19 and $i <=20){formulaire_duo_bool_radio($res,$lst,$i,$res2);}
                        else {formulaire_trio_radio($res,$lst,$i,$res2);}
                        $_SESSION[$res2] = null;
                    }

                    ?>
                    <div class="modif" align="center">
                        <br>
                        <input id="b2" onclick="verification('b1','b2')" type="submit" value="Modifier" >
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
