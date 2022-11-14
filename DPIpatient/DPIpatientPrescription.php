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
            </div>

        </div>
        <form class="table-container">
            <table>
                <caption>Plan d'administration</caption>
                <tr>
                    <td style="width: 20%">Médicaments</td>
                    <?php
                    if ($_SESSION['infosPersoPatient']['datefin']==""){
                        echo "<td>".date("o")."/".date("m")."/".date("d")."</td>";
                    }
                    echo $_SESSION['infosPersoPatient']['ipp'];
                    foreach ($_SESSION['infosPatient'] as $item ){
                        echo "<td>".$_SESSION['infosPatient']['jour']."</td>";
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
                                $liste = [];
                                $liste += [$_SESSION['infosPatient']];
                                print_r($_SESSION['infosPatient']);
                                foreach ($_SESSION['infosPatient'] as $item){
                                    echo "<tr>";
                                    echo "<td>$item[4]</td>";
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
                    /*foreach ($_SESSION[''] as $item){
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
                    }*/
                    ?>
                </tr>
            </table>
        </form>
    </div>
</div>
</body>
</html>
