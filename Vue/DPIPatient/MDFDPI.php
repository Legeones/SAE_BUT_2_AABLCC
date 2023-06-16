<?php
session_start();
require ('../../Controleur/DPIPatient/Principal_PHP_Fonction_DPI_ADD_or_Modif.php')
?>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header id="haut">
    <img class="logo" src="../../Images/logoIFSI.png" alt="LogoIFSI">
    <button type="button" title="Déconnexion" id="logout" class="logout" onclick="location.href='../Accueil/Deconnexion.php'"><img id="img_logout" src="../../Images/Logout.png"></button>
</header>
<div class="global">
    <?php
    include('../../Vue/Include/Menu_bouton.php')
    ?>
    <!-- zone de connexion -->
    <div class="droite">
        <div class="bas">
            <br>
            <form id="form" action="../../Controleur/DPIPatient/MDPDPI_PHP.php" method="post">
                <div class="recherche">
                    <input id="bt_retour" class="reset" onclick="location.href='MDF_Accueil.php'" type="button" value="Retour"/>
                    <div class="contenuRech">
                        <?php deroulementDPI(); ?>
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
