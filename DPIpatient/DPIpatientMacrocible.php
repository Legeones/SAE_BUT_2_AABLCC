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
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: gray; color: white;" type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
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

                        <h4>Nom:<?php print($_SESSION['infosPersoPatient']['nom']) ?></h4> <!-- Permet d'afficher le nom de la personne cherchée dans la base de données -->
                        <h4>Prenom:<?php print($_SESSION['infosPersoPatient']['prenom']) ?></h4> <!-- Permet d'afficher le prénom de la personne cherchée dans la base de données -->
                        <h4>Ville de naissance:</h4> <!-- Onglet ville de naissance -->
                        <h4>Date de naissance:<?php print($_SESSION['infosPersoPatient']['ddn']) ?></h4> <!-- Permet d'afficher la date de naissance de la personne cherchée dans la base de données -->
                        <h4>Poids:<?php print($_SESSION['infosPersoPatient']['poids_kg']) ?>kg</h4> <!-- Permet d'afficher le poids de la personne cherchée dans la base de données -->
                        <h4>Taille:<?php print($_SESSION['infosPersoPatient']['taille_cm']) ?>cm</h4> <!-- Permet d'afficher la taille de la personne cherchée dans la base de données -->
                        <h4>IEP:<?php print($_SESSION['infosPersoPatient']['iep']); ?></h4> <!-- Permet d'afficher l'iep de la personne cherchée dans la base de données -->
                        <h4>IPP: <?php print($_SESSION['infosPersoPatient']['ipp']); ?></h4> <!-- Permet d'afficher l'ipp de la personne cherchée dans la base de données -->
                        <h4>Type hospitalisation: </h4> <!-- Onglet type d'hospitalisation -->
                        <h4>Date d'admission: <?php print($_SESSION['infosPersoPatient']['datedebut']); ?></h4> <!-- Permet d'afficher la date de début d'hospitalisation de la personne cherchée dans la base de données -->
                        <h4>Date de sortie: <?php print($_SESSION['infosPersoPatient']['datefin']); ?></h4> <!-- Permet d'afficher la date de sortie d'hospitalisation de la personne cherchée dans la base de données -->
                    </div>
                </div>
            <div class="info" onclick="show_data_patient_div('donn-admin');">
                <h2>Données administratives</h2>
                <div class="info-intern" id="donn-admin">
                    <h4>Adresse: </h4>
                    <p><?php print($_SESSION['infosPatient']['adresse'].", ".$_SESSION['infosPatient']['cp']." ".$_SESSION['infosPatient']['ville']) ?></p>
                    <h4>Tel personnel:</h4>
                    <p><?php print($_SESSION['infosPatient']['telpersonnel']); ?></p>
                    <h4>Tel professionnel:</h4>
                    <p><?php print($_SESSION['infosPatient']['telprofessionnel']); ?></p>
                    <h4>Personne a prevenir:</h4>
                    <p><?php print("Nom: ".$_SESSION['infosPersonneCont']['nom'].", prénom: ".$_SESSION['infosPersonneCont']['prenom']." (".$_SESSION['infosPersonneCont']['lien'].")"); ?></p>
                    <p><?php print("Tel: ".$_SESSION['infosPersonneCont']['tel'])?></p>
                    <h4>Personne de confiance:</h4>
                    <p><?php print("Nom: ".$_SESSION['infosPersonneConf']['nom'].", prénom: ".$_SESSION['infosPersonneConf']['prenom']." (".$_SESSION['infosPersonneConf']['lien'].")")?></p>
                    <p><?php print("Tel: ".$_SESSION['infosPersonneConf']['tel'])?></p>
                </div>
            </div>
            <div class="info" onclick="show_data_patient_div('donn-soc');">
                <h2>Données sociales</h2>
                <div class="info-intern" id="donn-soc">
                    <h4>Mesure de protection:<?php print($_SESSION['infosPatient']['mesuredeprotection'])?></h4>
                    <h4>Suivi assistant social:<?php print($_SESSION['infosPatient']['asistantsocial'])?></h4>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('info-medi');">
                <h2>Infos médicales</h2>
                <div class="info-intern" id="info-medi">
                    <?php foreach ($_SESSION['infosPersonneMed'] as $m){
                        ?>
                            <h3>Medecin <?php print($m['lienmed']) ?></h3>
                            <p>Nom:<?php print($m['nom'])?></p>
                            <p>Prénom:<?php print($m['prenom'])?></p>
                            <p>Adresse:<?php print($m['adresse']).",".$m['cp'].",".$m['ville']?></p>
                        <?php
                    }
                    ?>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('donn-medi');">
                <h2>Données médicales</h2>
                <div class="info-intern" id="donn-medi">
                    <h4>Allergies:</h4>
                    <p><?php print($_SESSION['infosPatient']['allergies']); ?></p>
                    <h4>Antecedents:</h4>
                    <p><?php print($_SESSION['infosPatient']['antecedents']); ?></p>
                    <h4>Obstetricaux:</h4>
                    <p><?php print($_SESSION['infosPatient']['obstericaux']); ?></p>
                    <h4>Medicaux:</h4>
                    <p><?php print($_SESSION['infosPatient']['domedicaux']); ?></p>
                    <h4>Chirurgicaux:</h4>
                    <p><?php print($_SESSION['infosPatient']['dochirurgicaux']); ?></p>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('trait-dom');">
                <h2>Traitement à domicile</h2>
                <div class="info-intern" id="trait-dom">
                    <p><?= $_SESSION['infosPatient']['traidomi'] ?></p>
                </div>

            </div>
            <div class="info" onclick="show_data_patient_div('macro-ent');">
                <h2>Macrocible d'entrée</h2>
                <div class="info-intern" id="macro-ent">
                    <h4>Synthèse d'entrée</h4>
                    <p><?php print($_SESSION['infosPatient']['synentre']); ?></p>
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
