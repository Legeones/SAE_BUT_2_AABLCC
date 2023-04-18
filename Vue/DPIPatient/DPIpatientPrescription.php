<?php
session_start();
require ('../../Controleur/DPIPatient/patientDPIfunction.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <!-- importation des fichiers de style -->
    <link rel="stylesheet" href="../DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img class="logo" src="../../Images/logoIFSI.png">
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
            <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        </div>
    </div>
    <div class="droite">
        <script type="text/javascript" src="../../Controleur/DPIPatient/scriptsDPIpatient.js"></script>
        <!-- zone d'ajout de boutons -->
        <form action="../../Controleur/DPIPatient/actionDPI.php" name="cat" method="get" class="btn-line">
            <!-- zone d'ajout de boutons -->
            <input style="background-color: white;" type="submit" id="macrocible" name="Macrocible" onmouseover="alterner('macrocible');" onmouseout="alterner('macrocible');" value="macrocible">
            <input style="background-color: white;" type="submit" id="observation" name="Observation" onmouseover="alterner('observation');" onmouseout="alterner('observation');" value="Observation médicale">
            <input style="background-color: gray; color: white;" type="submit" id="prescription" name="Prescription" onmouseover="alterner('prescription');" onmouseout="alterner('prescription');" value="Prescription">
            <input style="background-color: white;" type="submit" id="intervenants" name="Intervenants" onmouseover="alterner('intervenants');" onmouseout="alterner('intervenants');" value="Intervenants">
            <input style="background-color: white;" type="submit" id="diagramme" name="Diagramme" onmouseover="alterner('diagramme');" onmouseout="alterner('diagramme');" value="Diagramme de soins">
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
        <div style="overflow-x: scroll;overflow-y: scroll";>
            <form class="table-container" method="get" action="../../Controleur/DPIPatient/patientDPIfunction.php">
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
                                    <td style="color: white">.</td>
                                </tr>
                                    <?php
                                    foreach ($_SESSION['infosPatient'] as $item){
                                        echo "<tr class='table-tr-recipient'>";
                                        echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$item['traitement']."</div></td>";
                                        echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$item['type']."</div></td>";
                                        echo "</tr>";
                                    }
                                    echo "<td class='table-td-recipient'><textarea name='traitement' placeholder='Traitement'></textarea></td>";
                                    echo "<td class='table-td-recipient'><textarea name='type' placeholder='Type'></textarea></td>";
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
                                            <?php if ($value['heure']=="20h00") {
                                                echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=".$value['fait']."></div></td>";
                                            } elseif ($value['heure']=="12h00"){
                                                echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=".$value['fait']."></div></td>";
                                            } elseif ($value['heure']=="08h00"){
                                                echo "<td class='table-td-recipient'><div class='table-td-div-recipient'><input type='text' value=".$value['fait']."></div></td>";
                                            }
                                            ?>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td class='table-td-recipient'><input type='text' name="value20" placeholder="Action dans l'intervalle 20h à 8h"></td>
                                        <td class='table-td-recipient'><input type='text' name="value12" placeholder="Action dans l'intervalle 12h à 20h"></td>
                                        <td class='table-td-recipient'><input type='text' name="value8" placeholder="Action dans l'intervalle 8h à 12h"></td>
                                    </tr>
                            </td>
                        <?php }
                        foreach ($listeJour as $item){ ?>
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
                                echo "<tr class='table-tr-recipient'>";
                                if ($value['heure']=="20h00"){
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$value['fait']."</div></td>";
                                } else {
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                }
                                if ($value['heure']=="12h00"){
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$value['fait']."</div></td>";
                                } else {
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                }
                                if ($value['heure']=="08h00"){
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'>".$value['fait']."</div></td>";
                                } else {
                                    echo "<td class='table-td-recipient'><div class='table-td-div-recipient'></div></td>";
                                }
                                echo "</tr>";
                            } ?>
                                    <tr>
                                        <td class='table-td-recipient'><input type='text' name="value20" placeholder="Action dans l'intervalle 20h à 8h"></td>
                                        <td class='table-td-recipient'><input type='text' name="value12" placeholder="Action dans l'intervalle 12h à 20h"></td>
                                        <td class='table-td-recipient'><input type='text' name="value8" placeholder="Action dans l'intervalle 8h à 12h"></td>
                                    </tr>
                                </table>
                            </td>
                        <?php }
                        ?>
                    </tr>
                </table><input type="submit" value="Enregistrer" formtarget="_top">
            </form>
        </div>
    </div>
</div>
</body>
</html>
