<?php
$_SESSION['cat']=null;
$_SESSION['patientSuivi']=null;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>DPI</title>
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<?php
include('../../Vue/Include/Header.php')
?>
<div class="global">
    <?php
        include('../../Vue/Include/Menu_bouton.php')
    ?>
    <div id="droit" class="droite">
        <form id="formulaire_recherche" action="../../Controleur/DPIPatient/actionPrincipale.php" method="get">
            <label><input id="recherche_barre" name="recherche_barre"></label>
            <label><select id="ordre" name="select">
                <option name="aucun">Aucun</option>
                <option name="dh">Date hospitalisation</option>
                <option name="oa">Ordre alphabetique</option>
                </select></label>
            <label><select id="admission" name="admi">
                <option value="IPP" name="IPP">IPP</option>
                <option value="IEP" name="IEP">IEP</option>
            </select></label>
            <button id="rechercher" type="submit">Rechercher</button>
            <button name="back">Back</button>
            <button name="next">Next</button>
        </form>
        <form name="choixPatient" action="../../Controleur/DPIPatient/actionDPI.php" method="post" class="grid-container" id="form">

        </form>

    </div>

    <script defer src="../../Controleur/DPIPatient/script_principal_dpi.js">
</body>

