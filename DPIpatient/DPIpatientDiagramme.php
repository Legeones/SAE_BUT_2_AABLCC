<?php
session_start();
?>
<html>
<head>
    <!-- importation des fichiers de style -->
    <meta charset="utf-8">
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
        <!-- zone d'ajout de boutons  -->
        <form action="actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input style="background-color: gray; color: white;" type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
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
        <form class="table-container" method="post" action="AjouterDPI.php">
            <table>
                <caption>Plan d'administration</caption>
                <tr>
                    <td style="width: 20%">Médicaments</td>
                    <?php
                    $present = array_search(date("o")."-".date("m")."-".date("d"),$_SESSION['infosPatient']);
                    if ($_SESSION['infosPersoPatient']['datefin']=="" && !$present){
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
                            <tr>PO</tr>
                            <tr>
                                <td style="color: white">.</td>
                            </tr>
                            <?php
                            $ligne=array();
                            $categories = array();
                            $nomsoin = array();
                            foreach ($_SESSION['infosPatient'] as $item){
                                if (in_array($item['categorie'],$categories)){

                                } else {
                                    array_push($categories,$item['categorie']);array_push($ligne,$item['categorie']);
                                    echo "<tr class='table-tr-recipient'>";
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$item['categorie']."</div></td>";
                                    echo "</tr>";
                                    foreach ($_SESSION['infosPatient'] as $value){
                                        if (!in_array($value['nom'],$nomsoin) && $value['categorie'] == $item['categorie']){
                                            array_push($nomsoin,$value['nom']);array_push($ligne,$value['nom']);
                                            echo "<tr class='table-tr-recipient'>";
                                            echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$value['nom']."</div></td>";
                                            echo "</tr>";
                                        }
                                    }
                                }
                            }
                            echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><i></i></div></td>";
                            ?>
                        </table>
                    </td>
                    <?php
                    if ($_SESSION['infosPersoPatient']['datefin']=="" && !$present){ ?>
                    <td>
                        <table>
                            <tr>PO</tr>
                            <tr>
                                <td>20:00</td>
                                <td>12:00</td>
                                <td>08:00</td>
                            </tr>
                            <?php
                            foreach ($_SESSION['infosPatient'] as $value){
                                ?>
                                <tr>
                                    <?php if ($value['heure']>='20:00:00.00' && $value['heure']<'08:00:00.00') {
                                        echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=".$value['fait']."></div></td>";
                                    } elseif ($value['heure']>='12:00:00.00' && $value['heure']<'20:00:00.00'){
                                        echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=".$value['fait']."></div></td>";
                                    } elseif ($value['heure']>='08:00:00.00' && $value['heure']<'12:00:00.00'){
                                        echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=".$value['fait']."></div></td>";
                                    }
                                    ?>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=""></div></td>
                                <td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text'></div></td>
                                <td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text'></div></td>
                            </tr>
                            </td>
                            <?php }
                            foreach ($listeJour as $jour){?>
                                <td>
                                    <table>
                                        <tr>PO</tr>
                                        <tr>
                                            <td>20:00</td>
                                            <td>12:00</td>
                                            <td>08:00</td>
                                        </tr>
                                        <?php
                                        foreach ($ligne as $value){
                                            $casesRemplis = [];
                                            echo "<tr class='table-tr-recipient'>";
                                            if (in_array($value,$categories)){
                                                echo "<td class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                                echo "<td class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                                echo "<td class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                            } else {
                                                foreach ($_SESSION['infosPatient'] as $item) {
                                                    if (!in_array($value, $categories)) {
                                                        if ($item['jour'] == $jour && $item['heure'] >= '20:00:00.00' && $item['heure'] < '08:00:00.00' && $item['nom'] == $value) {
                                                            $casesRemplis[] = 20;
                                                            if ($item['effectuer']) {
                                                                echo "<td class='table-td-recipient' style='background-color: green'><div class='table-td-div-recipient'>" . $item['valeur'] . "</div></td>";
                                                            } else {
                                                                echo "<td class='table-td-recipient' style='background-color: red'><div class='table-td-div-recipient'>" . $item['valeur'] . "</div></td>";
                                                            }
                                                        }
                                                    }
                                                }
                                                if (!in_array(20,$casesRemplis)) {
                                                    echo "<td id='pro' class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                                }
                                                foreach ($_SESSION['infosPatient'] as $item) {
                                                    if (!in_array($value, $categories)) {
                                                        if ($item['jour'] == $jour && $item['heure'] >= '12:00:00.00' && $item['heure'] < '20:00:00.00' && $item['nom'] == $value) {
                                                            $casesRemplis[] = 12;
                                                            if ($item['effectuer']) {
                                                                echo "<td class='table-td-recipient' style='background-color: green'><div class='table-td-div-recipient'>" . $item['valeur'] . "</div></td>";
                                                            } else {
                                                                echo "<td class='table-td-recipient' style='background-color: red'><div class='table-td-div-recipient'>" . $item['valeur'] . "</div></td>";
                                                            }
                                                        }
                                                    }
                                                }
                                                if (!in_array(12,$casesRemplis)) {
                                                    echo "<td id='pro' class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                                }
                                                foreach ($_SESSION['infosPatient'] as $item) {
                                                    if (!in_array($value, $categories)) {
                                                        if ($item['jour'] == $jour && $item['heure'] >= '08:00:00.00' && $item['heure'] < '12:00:00.00' && $item['nom'] == $value) {
                                                            $casesRemplis[] = 8;
                                                            if ($item['effectuer']) {
                                                                echo "<td class='table-td-recipient' style='background-color: green'><div class='table-td-div-recipient'>" . $item['valeur'] . "</div></td>";
                                                            } else {
                                                                echo "<td class='table-td-recipient' style='background-color: red'><div class='table-td-div-recipient'>" . $item['valeur'] . "</div></td>";
                                                            }
                                                        }
                                                    }
                                                }
                                                if (!in_array(8,$casesRemplis)) {
                                                    echo "<td id='pro' class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                                }
                                                echo "</tr>";
                                            }
                                            }
                                         ?>
                                        <tr>
                                            <td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text'></div></td>
                                            <td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text'></div></td>
                                            <td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text'></div></td>
                                        </tr>
                                    </table>
                                </td>
                            <?php
                            }
                            ?>
                            </tr>
                        </table><input type="submit" value="Enregistrer" formtarget="_top">
        </form>
    </div>
</div>
</body>
</html>
