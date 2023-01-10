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
<header id="haut">
    <img class="logo" src="../Images/logoIFSI.png">
</header>
<div class="global">
    <div id="gauche" class="gauche">
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
                echo "<button onclick=location.href='Corbeille.php'> Mettre a la Corbeille</button>";
                echo '<br>';
                echo "<button onclick=location.href='AjouterDPI.php'> Ajouter</button>";
                echo '<br>';
                echo "<button onclick=location.href='FormulaireUpload.php'>Upload Image</button>";}
            echo '<br>';
            if ($_SESSION["Role"] == "admin") {echo "<button onclick=location.href='AttributionRole.php'>attribuer role</button>";
                echo '<br>';
                echo "<button onclick=location.href='FormulaireUnlink.php'>Supprimer Image</button>";
                echo '<br>';
                echo "<button onclick=location.href='SupprimerPatient.php'>Supprimer</button>";
                echo '<br>';
                echo "<button onclick=location.href='RecupCorbeille.php'>Recup Patient</button>";
                echo '<br>';}
            if ($_SESSION["Role"] == "pseudo-etu") {echo "<button onclick=location.href='RetourMode.php'>retour mode prof</button>";
                echo '<br>';}
            $_SESSION['infosPatient']=[];
            ?>
        </div>
    </div>
    <div id="droit" class="droite">
        <form id="formulaire_recherche" action="actionPrincipale.php" method="get">
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
            /*
            Ce code JavaScript définit une fonction apparait() qui rend visible ou invisible
            un élément HTML en fonction de son état actuel. L'élément cible est défini en utilisant
            l'argument d'entrée id pour récupérer un élément HTML en utilisant document.getElementById(id).
            Il vérifie également si le paramètre d'entrée est égal à "null" pour éviter les erreurs.

            Il y a également une variable onApparaitElement qui est utilisée pour détecter si l'élément
            est actuellement visible ou non.

            Il y a un écouteur d'événement qui est ajouté à document qui est appelé à chaque fois que
            la souris bouge, cela permet de mettre à jour la position de l'élément cible lorsqu'il est
            visible en utilisant les propriétés event.x et event.y pour récupérer les coordonnées de la souris.
            Il y a des conditions pour vérifier si l'élément est sorti de la zone visible et le décaler à sa place.
             */
            let mousePositionElement = document.getElementById('1');
            let onApparaitElement = false;
            function apparait(id) {
                if (id != 'null'){
                    mousePositionElement = document.getElementById(id);
                }
                var elt = document.getElementById(id);
                if (elt.style.visibility == "visible") {
                    elt.style.visibility = "hidden";
                    onApparaitElement = false;
                } else {
                    elt.style.visibility = "visible";
                    onApparaitElement = true;
                }
            }
            // Ajoute un écouteur d'événement qui sera appelé chaque fois que la souris bouge
            let x = 0;
            let y = 0;
            let poscote = 0;
            let posbas = 0;
            document.addEventListener("mousemove", (event) => {
                // Met à jour l'élément HTML avec la position de la souris
                if (onApparaitElement){
                    //console.log(event.x+(mousePositionElement.offsetTop+document.getElementById('haut').offsetHeight));
                    if (poscote > document.body.offsetWidth){
                        x = event.x-document.getElementById('gauche').offsetWidth-mousePositionElement.offsetWidth-30;
                        poscote = event.x+mousePositionElement.offsetWidth+40;
                    } else {
                        x = event.x-document.getElementById('gauche').offsetWidth;
                        poscote = event.x+mousePositionElement.offsetWidth+40;
                    }
                    if (posbas > document.body.offsetHeight){
                        y = event.y-document.getElementById('haut').offsetHeight-mousePositionElement.offsetHeight-document.getElementById('formulaire_recherche').offsetHeight;
                        posbas = event.y+mousePositionElement.offsetHeight+40;
                        console.log(document.body.offsetHeight+":"+(event.y+mousePositionElement.offsetHeight));
                    } else {
                        y = event.y-document.getElementById('haut').offsetHeight-document.getElementById('formulaire_recherche').offsetHeight;
                        posbas = event.y+mousePositionElement.offsetHeight+40;
                    }
                    mousePositionElement.style.left = `${x}px`;
                    mousePositionElement.style.top = `${y}px`;
                }

            });
        </script>
        <form name="choixPatient" action="actionDPI.php" method="post" class="grid-container" id="form">
            <?php
            /*
             * Ce code PHP crée une boucle qui itère de 1 à 24. Dans chaque itération, il définit une variable de session
             * nommée 'patientActuel' en concaténant "patient" avec la valeur actuelle de $i. Il crée également une variable
             * 'id' qui contient la valeur actuelle de $i convertie en chaîne de caractères. Il définit également une variable
             * de session nommée 'idActuel' en lui donnant la valeur de 'id'.
             *
             * Ensuite, il affiche une entrée HTML de type "submit" avec un nom qui est la valeur de
             * $_SESSION[$_SESSION['patientActuel']][0] si elle existe, ou 'null' sinon. Il donne également
             * un style de curseur de pointeur à cette entrée. Il utilise également des conditionnels pour vérifier
             * si $_SESSION[$_SESSION['patientActuel']] existe, et si c'est le cas, il ajoute des événements onmouseover
             * et onmouseout qui appelle une fonction apparait en passant en argument $_SESSION['idActuel'].
             *
             * Il y a un élément div en dessous de l'entrée qui est caché par défaut et a un attribut d'identifiant
             * qui est égal à $_SESSION['idActuel']. Il utilise des conditionnelles pour vérifier si certaines valeurs
             * de $_SESSION[$_SESSION['patientActuel']] existent et les affiche. Il affiche également la date
             * d'hospitalisation de cet utilisateur en utilisant $_SESSION[$_SESSION['patientActuel']]['datedebut'].
             *
             * Enfin, il finit la boucle pour passer à la prochaine itération. En gros c'est une boucle qui affiche
             * une liste de patients en ayant pour infos principales leur nom, prenom,ipp,iep et date d'hospitalisation.
             */
            for($i=1;$i<25;$i++){
                $_SESSION['patientActuel']='patient'.$i;
                $id = ''.$i;
                $_SESSION['idActuel'] = $id;
                ?> <input class="input_form_patients" type="submit" name="<?php if(isset($_SESSION[$_SESSION['patientActuel']])) { print $_SESSION[$_SESSION['patientActuel']][0];} else {print 'null';}?>"
                          style="cursor:pointer;" <?php if(isset($_SESSION[$_SESSION['patientActuel']])){?>
                    onmouseover="apparait(<?php echo $_SESSION['idActuel'] ?>)" onmouseout="apparait(<?php echo $_SESSION['idActuel'] ?>)"<?php }?>
                          value = <?php if(isset($_SESSION[$_SESSION['patientActuel']])) { print $_SESSION[$_SESSION['patientActuel']]['nom']."_".$_SESSION[$_SESSION['patientActuel']]['prenom'];}?>>
                <div class="hide" id=<?php echo $_SESSION['idActuel'] ?>>
                    <?php if(isset($_SESSION[$_SESSION['patientActuel']])) print ("IPP:".$_SESSION[$_SESSION['patientActuel']]['ipp']."<br>");
                    if(isset($_SESSION[$_SESSION['patientActuel']]['iep'])) print ("IEP:".$_SESSION[$_SESSION['patientActuel']]['iep']."<br>");
                    print("Date d'hospitalisation ".$_SESSION[$_SESSION['patientActuel']]['datedebut']); ?>
                </div>
            <?php }
            ?>
        </form>

    </div>

</body>
</html>
