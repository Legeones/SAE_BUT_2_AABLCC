<?php
session_start();
require ('../../Controleur/DPIPatient/patientDPIfunction.php');
?>
<!DOCTYPE html>
<head>
    <!-- importation des fichiers de style -->
    <title>Diagramme patient</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img alt="LogoIFSI" class="logo" src="../../Images/logoIFSI.png">
</header>
<body>
<!-- Zone de connexion -->

<div class="global">
    <div class="gauche" style="height: auto !important; min-height: 90%;">
        <div class="profile" id="space-invader">
            <img alt="Profile" width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='DPI.php'">PATIENTS</button>
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>

    <div class="droite">
        <script type="text/javascript" src="../../Controleur/DPIPatient/scriptsDPIpatient.js"></script>
        <!-- zone d'ajout de boutons  -->
        <form action="../../Controleur/DPIPatient/actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: white;" type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input style="background-color: white;" type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input style="background-color: white;" type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input style="background-color: gray; color: white;" type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
            <input style="background-color: white;" type="submit" id="biologie" name="Biologie" onmouseover="alterner('biologie');" onmouseout="alterner('biologie');" value="Biologie">
            <input style="background-color: white;" type="submit" id="imagerie" name="Imagerie" onmouseover="alterner('imagerie');" onmouseout="alterner('imagerie');" value="Imagerie">
            <input style="background-color: white;" type="submit" id="courriers" name="Courriers" onmouseover="alterner('courriers');" onmouseout="alterner('courriers');" value="Courriers">
        </form>

        <div class="container" >
            <div class="grid-container">
                <div class="info" onclick="openForm('donn-perso');">
                    <h2>Données personnelles</h2>
                </div>
            </div>
        </div>
        <div class="login-popup">
            <?= afficherDataPersos() ?>
        </div>
        <div style="overflow-y: scroll; overflow-x: scroll;">
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
                                <td class='table-td-recipient'><div class='table-td-div-recipient'><label><input type='text' value=""></label></div></td>
                                <td class='table-td-recipient'><div class='table-td-div-recipient'><label><input type='text' value=""></label></div></td>
                                <td class='table-td-recipient'><div class='table-td-div-recipient'><label><input type='text' value=""></label></div></td>
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
                                            <td class='table-td-recipient'><div class='table-td-div-recipient'><label><input type='text' value=""></label></div></td>
                                            <td class='table-td-recipient'><div class='table-td-div-recipient'><label><input type='text' value=""></label></div></td>
                                            <td class='table-td-recipient'><div class='table-td-div-recipient'><label><input type='text' value=""></label></div></td>
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
</div>
</body>
</>
