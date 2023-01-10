<script type="text/javascript" src="scriptsDPIpatient.js"></script>
<?php
function afficherDataPersos(){
    ?>
    <div class="info-popup" id="donn-perso">
        <h4>Nom:<?php print($_SESSION['infosPersoPatient']['nom']) ?></h4> <!-- Permet d'afficher le nom de la personne cherchée dans la base de données -->
        <h4>Prenom:<?php print($_SESSION['infosPersoPatient']['prenom']) ?></h4> <!-- Permet d'afficher le prénom de la personne cherchée dans la base de données -->
        <h4>Ville de naissance:</h4> <!-- Onglet ville de naissance -->
        <h4>Date de naissance:<?php print($_SESSION['infosPersoPatient']['date_de_naissance']) ?></h4> <!-- Permet d'afficher la date de naissance de la personne cherchée dans la base de données -->
        <h4>Poids:<?php print($_SESSION['infosPersoPatient']['poids_kg']) ?>kg</h4> <!-- Permet d'afficher le poids de la personne cherchée dans la base de données -->
        <h4>Taille:<?php print($_SESSION['infosPersoPatient']['taille_cm']) ?>cm</h4> <!-- Permet d'afficher la taille de la personne cherchée dans la base de données -->
        <h4>IEP:<?php print($_SESSION['infosPersoPatient']['iep']); ?></h4> <!-- Permet d'afficher l'iep de la personne cherchée dans la base de données -->
        <h4>IPP: <?php print($_SESSION['infosPersoPatient']['ipp']); ?></h4> <!-- Permet d'afficher l'ipp de la personne cherchée dans la base de données -->
        <h4>Type hospitalisation: </h4> <!-- Onglet type d'hospitalisation -->
        <h4>Date d'admission: <?php print($_SESSION['infosPersoPatient']['datedebut']); ?></h4> <!-- Permet d'afficher la date de début d'hospitalisation de la personne cherchée dans la base de données -->
        <h4>Date de sortie: <?php print($_SESSION['infosPersoPatient']['datefin']); ?></h4> <!-- Permet d'afficher la date de sortie d'hospitalisation de la personne cherchée dans la base de données -->
        <button onclick="closeForm('donn-perso')">Fermer</button>
    </div>
<?php }

if ($_SESSION['cat']=="Observation" && isset($_GET['date'])){
    try{
        $date = $_GET['date'];
        $init = $_GET['init'];
        $cible = $_GET['cible'];
        $donn = $_GET['donn'] ?? "";
        $act = $_GET['actions'] ?? "";
        $res = $_GET['result'] ?? "";
        Modif_Observation($date,$init,$cible,$donn,$act,$res);
    } catch (Exception $e){
        print "Problème de remplissage de données:".$e;
    }
} else if ($_SESSION['cat']=="Prescription" && isset($_GET['traitement'])){
    try{
        $traitement = $_GET['traitement'];
        $type = $_GET['type'];
        $v = $_GET['value20'] ?? $_GET['value12'] ?? $_GET['value08'] ?? "";
        Modif_Prescription($traitement,$type,$v);
    } catch (Exception $e){
        print "Problème de remplissage de données:".$e;
    }
}
?>

