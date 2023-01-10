<?php
session_start();
require "patientDPIfunction.php";
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->

    <link rel="stylesheet" href="DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img class="logo" src="../Images/logoIFSI.png">
</header>
<body>
<script type="text/javascript" src="scriptsDPIpatient.js"></script>
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
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: gray; color: white;" type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input style="background-color: white;" type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input style="background-color: white;" type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input style="background-color: white;" type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input style="background-color: white;" type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input style="background-color: white;" type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input style="background-color: white;" type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>
        <script type="text/javascript">

        </script>

        <div class="container" >
            <div class="grid-container">
                <div class="info" onclick="openForm('donn-perso');">
                    <h2>Données personnelles</h2>
                </div>
                <div class="info" onclick="openForm('donn-admin');">
                    <h2>Données administratives</h2>
                </div>
                <div class="info" onclick="openForm('donn-soc');">
                    <h2>Données sociales</h2>
                </div>
                <div class="info" onclick="openForm('info-medi');">
                    <h2>Infos médicales</h2>
                </div>
                <div class="info" onclick="openForm('donn-medi');">
                    <h2>Données médicales</h2>
                </div>
                <div class="info" onclick="openForm('trait-dom');">
                    <h2>Traitement à domicile</h2>
                </div>
                <div class="info" onclick="openForm('macro-ent');">
                    <h2>Macrocible d'entrée</h2>
                </div>
            </div>
        </div>
        <div class="login-popup">
            <?= afficherDataPersos() ?>
            <div class="info-popup" id="donn-admin">
                <h4>Adresse: </h4>
                <p><?php print($_SESSION['infosPatient']['adresse'].", ".$_SESSION['infosPatient']['code_postal']." ".$_SESSION['infosPatient']['ville']) ?></p>
                <h4>Tel personnel:</h4>
                <p><?php print($_SESSION['infosPatient']['telephone_personnel']); ?></p>
                <h4>Tel professionnel:</h4>
                <p><?php print($_SESSION['infosPatient']['telephone_professionnel']); ?></p>
                <h4>Personne a prevenir:</h4>
                <p><?php print("Nom: ".$_SESSION['infosPersonneCont']['nom'].", prénom: ".$_SESSION['infosPersonneCont']['prenom']." (".$_SESSION['infosPersonneCont']['lien'].")"); ?></p>
                <p><?php print("Tel: ".$_SESSION['infosPersonneCont']['telephone'])?></p>
                <h4>Personne de confiance:</h4>
                <p><?php print("Nom: ".$_SESSION['infosPersonneConf']['nom'].", prénom: ".$_SESSION['infosPersonneConf']['prenom']." (".$_SESSION['infosPersonneConf']['lien'].")")?></p>
                <p><?php print("Tel: ".$_SESSION['infosPersonneConf']['telephone'])?></p>
                <button onclick="closeForm('donn-admin')">Fermer</button>
            </div>
            <div class="info-popup" id="donn-soc">
                <h4>Mesure de protection:<?php print($_SESSION['infosPatient']['mesure_de_protection'])?></h4>
                <h4>Suivi assistant social:<?php print($_SESSION['infosPatient']['assistant_social'])?></h4>
                <button onclick="closeForm('donn-soc')">Fermer</button>
            </div>
            <div class="info-popup" id="info-medi">
                <?php foreach ($_SESSION['infosPersonneMed'] as $m){
                    ?>
                    <h3>Medecin <?php print($m['lienmed']) ?></h3>
                    <p>Nom:<?php print($m['nom'])?></p>
                    <p>Prénom:<?php print($m['prenom'])?></p>
                    <p>Adresse:<?php print($m['adresse']).",".$m['cp'].",".$m['ville']?></p>
                    <?php
                }
                ?>
                <button onclick="closeForm('info-medi')">Fermer</button>
            </div>
            <div class="info-popup" id="donn-medi">
                <h4>Allergies:</h4>
                <p><?php print($_SESSION['infosPatient']['allergies']); ?></p>
                <h4>Antecedents:</h4>
                <p><?php print($_SESSION['infosPatient']['antecedents']); ?></p>
                <h4>Obstetricaux:</h4>
                <p><?php print($_SESSION['infosPatient']['obstericaux']); ?></p>
                <h4>Medicaux:</h4>
                <p><?php print($_SESSION['infosPatient']['documents_medicaux']); ?></p>
                <h4>Chirurgicaux:</h4>
                <p><?php print($_SESSION['infosPatient']['documents_chirurgicaux']); ?></p>
                <button onclick="closeForm('donn-medi')">Fermer</button>
            </div>
            <div class="info-popup" id="trait-dom">
                <p><?= $_SESSION['infosPatient']['traitement_domicile'] ?></p>
                <button onclick="closeForm('trait-dom')">Fermer</button>
            </div>
            <div class="info-popup" id="macro-ent">
                <h4>Synthèse d'entrée</h4>
                <p><?php print($_SESSION['infosPatient']['synthese_entree']); ?></p>
                <p></p>
                <h4>Bilan d'autonomie:</h4>
                <table>
                    <tbody>
                    <tr>
                        <td>Mobilité</td>
                        <td><?php print($_SESSION['infosPatient']['mobilite'])?></td>
                    </tr>
                    <tr>
                        <td>Alimentation</td>
                        <td><?php print($_SESSION['infosPatient']['alimentation'])?></td>
                    </tr>
                    <tr>
                        <td>Hygiène corporelle</td>
                        <td><?php print($_SESSION['infosPatient']['hygiene'])?></td>
                    </tr>
                    <tr>
                        <td>Elimination</td>
                        <td><?php print($_SESSION['infosPatient']['toilette'])?></td>
                    </tr>
                    <tr>
                        <td>Habillement</td>
                        <td><?php print($_SESSION['infosPatient']['habit'])?></td>
                    </tr>
                    </tbody>
                </table>
                <p>Légende : 1 autonome / 2 avec aide partielle / 3 avec aide totale</p>
                <button onclick="closeForm('macro-ent')">Fermer</button>
            </div>
        </div>
        </div>
    </div>
</div>
</body>
</html>
