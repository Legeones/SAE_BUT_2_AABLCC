<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require ('../../Controleur/DPIPatient/Principal_PHP_Fonction_DPI_ADD_or_Modif.php')
?>
<html>
<head>
    <!-- zone d'importation des fichiers de style -->

    <meta charset="utf-8">
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
    <script src="../../Controleur/DPIPatient/scriptsDPIpatient.js"></script>
</head>
<body>

<header id="haut">
    <img class="logo" src="../../Images/logoIFSI.png" alt="LogoIFSI">
    <button type="button" title="Déconnexion" id="logout" class="logout" onclick="location.href='../Accueil/Deconnexion.php'"><img id="img_logout" src="../../Images/Logout.png"></button>
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <!-- zone de connexion -->
    <div class="droite">
        <div class="bas">
            <div class="lesForms" align="center">
                <button id="boutondebut" style="background-color:whitesmoke" onclick="suivantCourt('formDPI','formContact','formConfiance'), changeCouleurBouton('boutondebut','boutondebut1','boutondebut2')">Ajouter_DPI</button>
                <button id="boutondebut1" style="background-color:#66CCCC" onclick="suivantCourt('formContact','formDPI','formConfiance'), changeCouleurBouton('boutondebut1','boutondebut','boutondebut2')">Contact</button>
                <button id="boutondebut2" style="background-color:#66CCCC" onclick="suivantCourt('formConfiance','formDPI','formContact'), changeCouleurBouton('boutondebut2','boutondebut','boutondebut1')"">Confiance</button>

            </div>
            <form id="form" action="../../Controleur/DPIPatient/AjouterDPIPHP.php" method="post">
                <div id="formDPI" style="display: block">
                    <div class="Titreform">
                        <h1><u>Ajouter un DPI</u></h1>
                        <!-- Onglet ajouter un DPI -->
                    </div>
                    <div class="Groupe">
                        <?php if (isset($_SESSION['MessErreur']) && !empty($_SESSION['MessErreur'])):?> <!-- si la session comporte une erreur ou plus -->
                            <div class="groupeErreur">
                                <p>
                                    <?= $_SESSION['MessErreur'] ?> <!-- elle affiche le message d'erreur stoke dans la session -->
                                    <?php $_SESSION['MessErreur'] = null ?> <!-- elle est mise à nulle pour éviter que le message s'affiche même lors d'un reset de la page -->
                                </p>
                            </div>
                        <?php endif ?>
                        <p class="infoForm"><li><u>Certaines informations ne sont pas necéssaires et se définissent par "*".</u></li></p>
                        <!-- Ici un message apparait pour nous dire que certaines informations non nécessaires et se définissent par "*" -->

                    </div>
                    <p>L'ipp doit commencer par '80' et doit contenir 10 à 13 chiffres </p>
                    <?php
                    $lst = nameColonne('patient')[0]; // liste de tous les noms de la colonne
                    $lst1 = nameColonne('patient')[1]; // liste de tous les types de chaque colonne
                    $debut = 0;
                    $fin = sizeof($lst);
                    $_SESSION['Debut'] = $debut; // session pour le debut de l'intervalle qui sert pour les creations de sessions
                    $_SESSION['Fin'] = $fin;
                    for ($i = $debut; $i < $fin; $i++) {
                        if ($i == 1 or $i == 17){$i +=1;} // colonne pas utilisée pour le formulaire
                        if ($i == 18){$i +=1;} // colonne pas utilisée pour le formulaire
                        $type = "$lst1[$i]"; // type de formulaire
                        $res2 = 'val' . $i; // nom des sessions
                        $res = "$lst[$i]"; // nom des ids pour les inputs
                        if ($type == 'integer' or $type == 'double precision' or $type == 'numeric') {$type = "number";} // tout ce qui se rapproche à number deviennent number
                        if ($i <= 16 or $i >= 21 and $i<=24){formulaire($res, $lst, $i, $type, $res2);} // creation du formulaire en fonction de son type ainsi que sa forme (si c une check box ou autre )
                        elseif ($i >=19 and $i <=20){formulaire_duo_bool_radio($res,$lst,$i,$res2);} // creation du formulaire en fonction de son type ainsi que sa forme (si c une check box ou autre )
                        else {formulaire_trio_radio($res,$lst,$i,$res2);} // creation du formulaire en fonction de son type ainsi que sa forme (si c une check box ou autre )
                    }
                    ?>
                    <div class="Validation" align="center">
                        <button type="button" id="boutonSuivant2" onclick="suivant('formDPI','formContact'), changeCouleurBouton('boutondebut1','boutondebut','boutondebut2')">Suivant !</button>
                    </div>
                </div>
                <!*****************************************************************************************************>
                <div id="formContact" style="display:none">
                    <div class="Titreform">
                        <h1><u>Ajouter une Personne à Contacter </u></h1>
                        <!-- Onglet ajouter une personne à contacter -->
                    </div>
                    <?php
                    $lst = nameColonne('personnecontacte')[0];
                    $lst1 = nameColonne('personnecontacte')[1];
                    $debut = 31;
                    $fin = 35;
                    $_SESSION['Debutct'] = $debut;
                    $_SESSION['Finct'] = $fin;
                    $cpt = 1; // pour commencer les listes nameColonne avec un compteur est non pas de 31
                    for ($i = $debut; $i < $fin; $i++) {
                        $type = "$lst1[$cpt]";
                        $res2 = 'val' . $i;
                        $res = "$lst[$cpt]".'ct';
                        formulaire($res, $lst, $cpt, $type, $res2);
                        $cpt +=1;

                    }
                    ?>
                    <div class="Validation" align="center">
                        <button type="button" id="precedent3" onclick="suivant('formContact','formDPI'), changeCouleurBouton('boutondebut','boutondebut2','boutondebut1')">Précedent</button>
                        <button type="button" id="boutonSuivant2" onclick="suivant('formContact','formConfiance'), changeCouleurBouton('boutondebut2','boutondebut1','boutondebut')">Suivant !</button>
                    </div>
                </div>

                <!*****************************************************************************************************>
                <div id="formConfiance" style="display:none">
                    <div class="Titreform">
                        <h1><u>Ajouter une Personne de Confiance</u></h1>
                        <!-- Onglet ajouter une personne de confiance -->
                    </div>
                    <?php
                    $lst = nameColonne('personneconfiance')[0];
                    $lst1 = nameColonne('personneconfiance')[1];
                    $debut = 35;
                    $fin = 39;
                    $_SESSION['Debutcf'] = $debut;
                    $_SESSION['Fincf'] = $fin;
                    $cpt = 1; // pour commencer les listes nameColonne avec un compteur est non pas de 35
                    for ($i = $debut; $i < $fin; $i++) {
                        $type = "$lst1[$cpt]";
                        $res2 = 'val' . $i;
                        $res = "$lst[$cpt]".'cf';
                        formulaire($res, $lst, $cpt, $type, $res2);
                        $cpt += 1;
                    }
                    ?>
                    <div class="Validation" align="center">
                        <button type="button" id="precedent3" onclick="suivant('formConfiance','formContact'), changeCouleurBouton('boutondebut1','boutondebut2','boutondebut')">Précedent</button>
                        <input id="bt_validation" type="submit" value="Valider">
                    </div>
                </div>
            </form>
            <!-- met à 0 toutes les sessions utilisées -->
            <?php $_SESSION['lstErreur'] = null;
            $_SESSION['lstErreur_specifique'] = null;
            reset_session();?>
        </div>
    </div>
</div>
</body>
</html>
