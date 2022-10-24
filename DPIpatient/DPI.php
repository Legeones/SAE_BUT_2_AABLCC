<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="PrincipaleStyle.css" media="screen" type="text/css" />
</head>
<body>
<header>
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<div class="global">
    <!--<script type="text/javascript">
        $(document).ready(function(){
            $("#showit").click(function(){
                $("#myform").css("display","block");
            });
        });
    </script>-->
    <div class="gauche">
        <div class="profile">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
            <!-- choix du rôle -->
            <?php
            echo '<br>';
            if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof") {echo "<button onclick=location.href='transition.php'>Passer en mode etu</button>";}
            echo '<br>';
            if ($_SESSION["Role"] == "admin") {echo "<button onclick=location.href='AttributionRole.php'>attribuer role</button>";}
            echo '<br>';
            if ($_SESSION["Role"] == "pseudo-etu") {echo "<button onclick=location.href='RetourMode.php'>retour mode prof</button>";}
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
            <button type="submit">Rechercher</button>
            <button name="back">Back</button>
            <button name="next">Next</button>
        </form>
        <script>
            function apparait(id){
                var elt = document.getElementById(id);
                if(elt.style.visibility=="visible"){
                    elt.style.visibility = "hidden";
                } else {
                    elt.style.visibility = "visible";
                }
            }
        </script>
        <form name="choixPatient" action="actionDPI.php" method="post" class="grid-container">
            <?php
            for($i=1;$i<25;$i++){
                $_SESSION['patientActuel']='patient'.$i;
                $id = ''.$i;
                $_SESSION['idActuel'] = $id;
                ?> <input type="submit" name="<?php if(isset($_SESSION[$_SESSION['patientActuel']])) { print $_SESSION[$_SESSION['patientActuel']][1];} else {print $_SESSION['idActuel'];}?>"
                          style="cursor:pointer;" <?php if(isset($_SESSION[$_SESSION['patientActuel']])){?>
                    onmouseover="apparait(<?php echo $_SESSION['idActuel'] ?>)" onmouseout="apparait(<?php echo $_SESSION['idActuel'] ?>)"<?php }?>
                          value = <?php if(isset($_SESSION[$_SESSION['patientActuel']])) { print $_SESSION[$_SESSION['patientActuel']][1];}?>>
                <div class="<?php if($_SESSION['idActuel']%6==0) echo 'hideLeft'; else echo 'hide'; ?>" id=<?php echo $_SESSION['idActuel'] ?>>
                    <?php if(isset($_SESSION[$_SESSION['patientActuel']])) print $_SESSION[$_SESSION['patientActuel']][0];?></div>
                </input>
            <?php }
            ?>

        </form>

    </div>

</body>
</html>
