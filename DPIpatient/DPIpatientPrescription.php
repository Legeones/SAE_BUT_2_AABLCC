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
<!-- Zone de connexion -->

<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <div class="droite">
        <script type="text/javascript" src="scriptsDPIpatient.js"></script>
        <!-- zone d'ajout de boutons -->
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
            </div>

        </div>
        <form class="table-container">
            <?php //print_r($_SESSION['infosPatient']); ?>
            <table>
                <caption>Plan d'administration</caption>
                <tr>
                    <td style="width: 20%">Médicaments</td>
                    <?php
                    if ($_SESSION['infosPersoPatient']['datefin']==""){
                        echo "<td>".date("o")."-".date("m")."-".date("d")."</td>";
                    }
                    $listeJour = array();
                    foreach ($_SESSION['infosPatient'] as $item ){
                        if (in_array($item['jour'],$listeJour)){

                        } else {
                            $listeJour[] = $item['jour'];
                            echo "<td>".$item['jour']."</td>";
                        }
                    }
                    ?>
                </tr>
                <tr>
                    <td>
                        <table>
                            <tr>
                                <td style="color: white">.</td>
                            </tr>
                            <tr>PO</tr>
                            <tr>
                                <?php
                                foreach ($_SESSION['infosPatient'] as $item){
                                    echo "<tr>";
                                    echo "<td>".$item['traitement']."</td>";
                                    echo "</tr>";
                                }
                                echo "<td>/</td>";

                                ?>
                            </tr>
                        </table>
                    </td>
                    <?php
                    if ($_SESSION['infosPersoPatient']['datefin']==""){
                        echo "<td>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>20:00</td>";
                        echo "<td>12:00</td>";
                        echo "<td>08:00</td>";
                        echo "</tr>";
                        echo "<tr>PO</tr>";
                        echo "<tr>";
                        echo "<td>.</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";
                        echo "</table>";
                        echo "</td>";
                    }
                    foreach ($listeJour as $item){
                        echo "<td>";
                        echo "<table>";
                        echo "<tr>";
                        echo "<td>20:00</td>";
                        echo "<td>12:00</td>";
                        echo "<td>08:00</td>";
                        echo "</tr>";
                        echo "<tr>PO</tr>";
                        foreach ($_SESSION['infosPatient'] as $value){
                            echo "<tr>";
                            if ($value['heure']=="20h00"){
                                echo "<td>".$value['fait']."</td>";
                            } else {
                                echo "<td></td>";
                            }
                            if ($value['heure']=="12h00"){
                                echo "<td>".$value['fait']."</td>";
                            } else {
                                echo "<td></td>";
                            }
                            if ($value['heure']=="08h00"){
                                echo "<td>".$value['fait']."</td>";
                            } else {
                                echo "<td></td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                        echo "</td>";
                    }
                    ?>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
