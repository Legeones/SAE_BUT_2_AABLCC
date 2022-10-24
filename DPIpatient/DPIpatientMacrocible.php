<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->

    <link rel="stylesheet" href="DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<body>
<div class="global">
    <div class="gauche">
        <div class="profile">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <form name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input type="button" id="macrocible" onmouseover="alterner('macrocible')" onmouseout="alterner('macrocible')" onclick="location.href='DPIpatient.php';" value="macrocible">
            <input type="button" id="observation" onmouseover="alterner('observation')" onmouseout="alterner('observation')" onclick="location.href='DPIpatientObservation.php';" value="Observation médicale">
            <input type="button" id="prescription" onmouseover="alterner('prescription')" onmouseout="alterner('prescription')" onclick="location.href='DPIpatientPrescription.php';" value="Prescription">
            <input type="button" id="diagramme" onmouseover="alterner('diagramme')" onmouseout="alterner('diagramme')" onclick="location.href='DPIpatientDiagramme.php';" value="Diagramme de soins">
            <input type="button" id="biologie" onmouseover="alterner('biologie')" onmouseout="alterner('biologie')" onclick="location.href='DPIpatientBiologie.php';" value="Biologie">
            <input type="button" id="imagerie" onmouseover="alterner('imagerie')" onmouseout="alterner('imagerie')" onclick="location.href='DPIpatientImagerie.php';" value="Imagerie">
            <input type="button" id="courrier" onmouseover="alterner('courrier')" onmouseout="alterner('courrier')" onclick="location.href='DPIpatientCourriers.php';" value="Courriers">
        </form>
        <script type="text/javascript">

        </script>
        <div class="container">
            <?php
            //print_r($_SESSION['infosPatient']);
            ?>
            <NOBR>
            <div class="info">
                <h2>Données personnelles</h2>
                <h4>Nom:<?php print($_SESSION['infosPatient'][2]) ?></h4>
                <h4>Prenom:<?php print($_SESSION['infosPatient'][3]) ?></h4>
                <h4>Ville de naissance:</h4>
                <h4>Date de naissance:<?php print($_SESSION['infosPatient'][4]) ?></h4>
                <h4>Poids:<?php print($_SESSION['infosPatient'][5]) ?>kg</h4>
                <h4>Taille:<?php print($_SESSION['infosPatient'][6]) ?>cm</h4>
                <h4>IEP:<?php print($_SESSION['infosPatient'][1]); ?></h4>
                <h4>IPP: <?php print($_SESSION['infosPatient'][0]); ?></h4>
                <h4>Type hospitalisation: </h4>
                <h4>Date d'admission: <?php print($_SESSION['infosPatient'][31]); ?></h4>
                <h4>Date de sortie: <?php print($_SESSION['infosPatient'][32]); ?></h4>
            </div>
            <div class="info">
                <h2>Données administratives</h2>
                <h4>Adresse: </h4>
                <p><?php print($_SESSION['infosPatient'][7].", ".$_SESSION['infosPatient'][8]." ".$_SESSION['infosPatient'][9]) ?></p>
                <h4>Tel personnel:</h4>
                <p><?php print($_SESSION['infosPatient'][10]); ?></p>
                <h4>Tel professionnel:</h4>
                <p><?php print($_SESSION['infosPatient'][11]); ?></p>
                <h4>Personne a prevenir:</h4>
                <p><?php print("Nom: ".$_SESSION['infosPatient'][26].", prénom: ".$_SESSION['infosPatient'][27]." (".$_SESSION['infosPatient'][29].")"); ?></p>
                <p><?php print("Tel: ".$_SESSION['infosPatient'][28])?></p>
                <h4>Personne de confiance:</h4>
                <p><?php print("Nom: ".$_SESSION['infosPatient'][20].", prénom: ".$_SESSION['infosPatient'][21]." (".$_SESSION['infosPatient'][23].")")?></p>
                <p><?php print("Tel: ".$_SESSION['infosPatient'][22])?></p>
            </div>
            <div class="info">
                <h2>Données sociales</h2>
                <h4>Mesure de protection: A implementer</h4>
                <h4>Suivi assistant social: A implementer</h4>
            </div>
            <div class="info">
                <h2>Infos médicales</h2>
                <h4>Medecin traitant:</h4>
                <h4>Medecin specialisé:</h4>
                <h4>Medecin referent:</h4>
            </div>
            <div class="info">
                <h2>Données médicales</h2>
                <h4>Allergies:</h4>
                <p><?php print($_SESSION['infosPatient'][12]); ?></p>
                <h4>Antecedents:</h4>
                <p><?php print($_SESSION['infosPatient'][13]); ?></p>
                <h4>Obstetricaux:</h4>
                <p><?php print($_SESSION['infosPatient'][14]); ?></p>
                <h4>Medicaux:</h4>
                <p><?php print($_SESSION['infosPatient'][15]); ?></p>
                <h4>Chirurgicaux:</h4>
                <p><?php print($_SESSION['infosPatient'][16]); ?></p>
            </div>
            <div class="info">
                <h2>Traitement à domicile</h2>
                <p></p>
            </div>
            <div class="info">
                <h2>Macrocible d'entrée</h2>
                <h4>Synthèse d'entrée</h4>
                <p><?php print($_SESSION['infosPatient'][10]); ?></p>
                <p></p>
                <h4>Bilan d'autonomie:</h4>
                <table>
                    <tbody>
                    <tr>
                        <td>Mobilité</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Alimentation</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Hygiène corporelle</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Elimination</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Habillement</td>
                        <td>Oui</td>
                    </tr>
                    </tbody>
                </table>
                <p>Légende : 1 autonome / 2 avec aide partielle  / 3 avec aide totale</p>
            </div>


        </div>
    </div>
</div>
</body>
</html>
