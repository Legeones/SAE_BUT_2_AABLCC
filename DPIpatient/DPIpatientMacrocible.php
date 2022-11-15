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
        <?= $_SESSION['patientSuivi'] ?>
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>
        <script type="text/javascript">

        </script>

        <div class="container" >
            <div class="grid-container">

                <div class="info" onclick="show_data_patient_div('donn-perso');">
                    <h2>Données personnelles</h2>
                    <div class="info-intern" id="donn-perso">

                        <h4>Nom:<?php print($_SESSION['infosPersoPatient']['nom']) ?></h4>
                        <h4>Prenom:<?php print($_SESSION['infosPersoPatient']['prenom']) ?></h4>
                        <h4>Ville de naissance:</h4>
                        <h4>Date de naissance:<?php print($_SESSION['infosPersoPatient']['ddn']) ?></h4>
                        <h4>Poids:<?php print($_SESSION['infosPersoPatient']['poids_kg']) ?>kg</h4>
                        <h4>Taille:<?php print($_SESSION['infosPersoPatient']['taille_cm']) ?>cm</h4>
                        <h4>IEP:<?php print($_SESSION['infosPersoPatient']['iep']); ?></h4>
                        <h4>IPP: <?php print($_SESSION['infosPersoPatient']['ipp']); ?></h4>
                        <h4>Type hospitalisation: </h4>
                        <h4>Date d'admission: <?php print($_SESSION['infosPersoPatient']['datedebut']); ?></h4>
                        <h4>Date de sortie: <?php print($_SESSION['infosPersoPatient']['datefin']); ?></h4>
                    </div>
                </div>
            <div class="info" onclick="show_data_patient_div('donn-admin');">
                <h2>Données administratives</h2>
                <div class="info-intern" id="donn-admin">
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
            </div>
            <div class="info" onclick="show_data_patient_div('donn-soc');">
                <h2>Données sociales</h2>
                <div class="info-intern" id="donn-soc">
                    <h4>Mesure de protection: A implementer</h4>
                    <h4>Suivi assistant social: A implementer</h4>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('info-medi');">
                <h2>Infos médicales</h2>
                <div class="info-intern" id="info-medi">
                    <h4>Medecin traitant:</h4>
                    <h4>Medecin specialisé:</h4>
                    <h4>Medecin referent:</h4>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('donn-medi');">
                <h2>Données médicales</h2>
                <div class="info-intern" id="donn-medi">
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

            </div>
            <div class="info" onclick="show_data_patient_div('trait-dom');">
                <h2>Traitement à domicile</h2>
                <div class="info-intern" id="trait-dom">
                    <p>Vide</p>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('macro-ent');">
                <h2>Macrocible d'entrée</h2>
                <div class="info-intern" id="macro-ent">
                    <h4>Synthèse d'entrée</h4>
                    <p><?php print($_SESSION['infosPatient'][10]); ?></p>
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
                    <p>Légende : 1 autonome / 2 avec aide partielle  / 3 avec aide totale</p>
                </div>

            </div>
        </div>

        </div>
    </div>
</div>
</body>
</html>
