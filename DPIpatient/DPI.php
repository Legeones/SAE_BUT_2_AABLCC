<?php
session_start();
$_SESSION['cat']=null;
$_SESSION['patientSuivi']=null;
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../Verif_Test/CSS_DPI.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="../Images/logoIFSI.png">
</header>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='../DPIpatient/DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
            <!-- choix du rôle -->
           <?php
                        echo '<br>';
            if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof") {echo "<button onclick=location.href='transition.php'>Passer en mode etu</button>";
                echo '<br>';
                echo "<button onclick=location.href='Corbeille.php'> Mettre a la Corbeille</button>"; // Bouton permettant de mettre à la corbeille
                echo '<br>';
                echo "<button onclick=location.href='AjouterDPI.php'> Ajouter</button>"; // Bouton permettant d'ajouter
                echo '<br>';
                echo "<button onclick=location.href='FormulaireUpload.php'>Upload Image</button>";} // Bouton permettant d'upload une image
            echo '<br>';
            if ($_SESSION["Role"] == "admin") {echo "<button onclick=location.href='AttributionRole.php'>attribuer role</button>"; // Bouton permettant d'attribuer un rôle
                echo '<br>';
                echo "<button onclick=location.href='FormulaireUnlink.php'>Supprimer Image</button>"; // Bouton permettant de supprimer une image
                echo '<br>';
                echo "<button onclick=location.href='SupprimerPatient.php'>Supprimer</button>"; // Bouton permettant de supprimer un patient
                echo '<br>';
                echo "<button onclick=location.href='RecupCorbeille.php'>Recup Patient</button>"; // Bouton permettant de récupèrer un patient
                echo '<br>';}
            if ($_SESSION["Role"] == "pseudo-etu") {echo "<button onclick=location.href='RetourMode.php'>retour mode prof</button>"; // Bouton permettant de retourner dans le mode prof
                echo '<br>';}
            $_SESSION['infosPatient']=[];
            ?>
        </div>
    </div>
    <div class="droite">
        <form action="actionPrincipale.php" method="get">
            <input name="recherche_barre"></input>
            <select name="select">
                <option name="aucun">Aucun</option>
                <option name="dh">Date hospitalisation</option>
                <option name="oa">Ordre alphabetique</option>
            </select>
            <select name="admi">
                <option value="IPP" name="IPP">IPP</option>
                <option value="IEP" name="IEP">IEP</option>
            </select>
            <button type="submit">Rechercher</button>
            <button name="back">Back</button>
            <button name="next">Next</button>
        </form>
        <script>
            function apparait(id){
                console.log("wow");
                var elt = document.getElementById(id);
                if(elt.style.visibility=="visible"){
                    elt.style.visibility = "hidden";
                } else {
                    elt.style.visibility = "visible";
                }
            }
        </script>
        <form name="choixPatient" action="actionDPI.php" method="post" class="grid-container" id="form">
            <?php
            for($i=1;$i<25;$i++){
                $_SESSION['patientActuel']='patient'.$i;
                $id = ''.$i;
                $_SESSION['idActuel'] = $id;
                ?> <input type="submit" name="<?php if(isset($_SESSION[$_SESSION['patientActuel']])) { print $_SESSION[$_SESSION['patientActuel']][0];} else {print 'null';}?>"
                          style="cursor:pointer;" <?php if(isset($_SESSION[$_SESSION['patientActuel']])){?>
                    onmouseover="apparait(<?php echo $_SESSION['idActuel'] ?>)" onmouseout="apparait(<?php echo $_SESSION['idActuel'] ?>)"<?php }?>
                          value = <?php if(isset($_SESSION[$_SESSION['patientActuel']])) { print $_SESSION[$_SESSION['patientActuel']]['nom'];}?>>

                <div class="hide" id=<?php echo $_SESSION['idActuel'] ?>>
                    <?php if(isset($_SESSION[$_SESSION['patientActuel']])) print ("IPP:".$_SESSION[$_SESSION['patientActuel']]['ipp']."<br>");
                    if(isset($_SESSION[$_SESSION['patientActuel']]['iep'])) print ("IEP:".$_SESSION[$_SESSION['patientActuel']]['iep']);?>
                </div>
                </input>
            <?php }
            ?>

        </form>

    </div>

</body>
</html>
