<?php

require('../BDD/DataBase_Core.php');


function Patient_Parcour($p,$rm,$rma): void
/*
 * Cette fonction parcour tous les patients et les ressorts en fonction des paramètres de recherche implantés.
 * $rm sert à la recherche par nom
 * $p sert à la recherche via Aucun, Date d'hospitalisation et enfin Ordre alphabétique
 * $rma sert pour la recherche renvoyant soit la dernière hospitalisation en fonction de l'IPP ou alors toutes les
 * hospitalisations en fonction de l'IPP
 */
{
    $o = 1;
    if(isset($_SESSION['patient1']) && $_SESSION['patient1']!=null){
        $pat = 'patient'.$o;
        for($i=0;$i<$_SESSION['incrPat']+24;$i++){
            if (isset($_SESSION[$pat])!=null){
                $_SESSION[$pat]=null;
            }
            $o+=1;
            $pat='patient'.$o;
        }
    }

    $dbh = DataBase_Creator_Unit();
    if($rm!='aucun'){
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT DISTINCT ON (patient.ipp) patient.ipp, nom, prenom, admission.dateDebut FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb LEFT JOIN(SELECT datedebut, ipp FROM admission ORDER BY iep DESC) admission ON admission.ipp = patient.IPP where nom like ? and IPPCorb is null LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.IPP, nom, prenom, datedebut FROM patient left join admission on patient.ipp = admission.ipp left join Corbeille C on Patient.IPP = C.IPPCorb WHERE nom like ? and IPPCorb is null ORDER BY iep DESC LIMIT ? OFFSET ?");
        }
        $stmt->bindParam(1,$rm);
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(2,$lim);
        $stmt->bindParam(3,$_SESSION['incrPat']);
        $stmt->execute();
    }

    if ($p=='Date hospitalisation' && $rm=='aucun') {
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT * FROM(SELECT DISTINCT ON (patient.ipp) patient.ipp, nom, prenom, admission.dateDebut FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb JOIN(SELECT datedebut, ipp FROM admission ORDER BY iep DESC) admission ON admission.ipp = patient.IPP where IPPCorb is null LIMIT ? OFFSET ?) patients ORDER BY patients.datedebut DESC ");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.ipp,nom,prenom, datedebut FROM patient JOIN admission ON admission.ipp = patient.ipp  left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is  null ORDER BY admission.iep DESC LIMIT ? OFFSET ?");
        }
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT DISTINCT ON (patient.ipp,nom) patient.ipp, nom, prenom, MAX(admission.dateDebut) as dateDebut FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb LEFT JOIN(SELECT datedebut, ipp FROM admission ORDER BY iep DESC) admission ON admission.ipp = patient.IPP where IPPCorb is null GROUP BY patient.ipp, nom, prenom ORDER BY nom LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.IPP,nom,prenom,datedebut FROM patient left join admission on patient.ipp = admission.ipp left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null ORDER BY nom, admission.iep LIMIT ? OFFSET ?");
        }
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif($rm=='aucun') {
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT DISTINCT ON (patient.ipp) patient.ipp, nom, prenom, MAX(admission.dateDebut) as dateDebut FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb LEFT JOIN(SELECT datedebut, ipp FROM admission ORDER BY iep DESC) admission ON admission.ipp = patient.IPP where IPPCorb is null GROUP BY patient.ipp, nom, prenom LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.IPP,nom,prenom,datedebut FROM patient left join admission on patient.ipp = admission.ipp left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null ORDER BY admission.iep LIMIT ? OFFSET ?");
        }
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    }
    $i = 1;
    foreach ($stmt as $p){
        if($i<$_SESSION['incrPat']){
            $i = $i+1;
        } else {
            $numeroPatient = "patient".$i;
            $_SESSION[$numeroPatient] = $p;
            $i = $i+1;
        }
    }
    header(DPIReturn());
}

function Data_Patient_Querry($nomPatient, $nomCateg){
    /*
     * Ce code PHP contient une fonction appelée "Data_Patient_Querry", qui prend en entrée le nom d'un patient
     * et le nom d'une catégorie de recherche de données. La fonction utilise la classe PDO pour se connecter à
     * une base de données et exécuter une requête en fonction de la catégorie de recherche de données. La fonction
     * stocke les informations sur le patient dans une variable de session, puis utilise une boucle foreach pour
     * ajouter ces informations à une variable appelée "infosPersoPatient". Enfin, il vérifie si la catégorie de
     * recherche de données est "Macrocible" ou autres et exécute des requêtes supplémentaires pour récupérer des informations
     * supplémentaires sur le patient en utilisant le nom ou le numéro de l'IPP ou IEP qui est stocké dans une variable
     * de session.
     */
    $pdo = DataBase_Creator_Unit();
    if ($_SESSION['paramRechercheAdmi']=='IPP'){
        $info = $pdo->prepare("SELECT patient.ipp, a.iep, nom, prenom, date_de_naissance, ville, poids_kg, taille_cm, datedebut, datefin FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE patient.ipp = ?");
    } else{
        $info = $pdo->prepare("SELECT patient.ipp, a.iep, nom, prenom, date_de_naissance, ville, poids_kg, taille_cm, datedebut, datefin FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE a.iep = ?");
    }
    $info -> bindParam(1,$nomPatient);
    $info->execute();
    $_SESSION['infosPersoPatient']=[];
    foreach ($info as $item){
        $_SESSION['infosPersoPatient']+=$item;
    }
    if ($nomCateg == "Macrocible"){
        if ($_SESSION['paramRechercheAdmi'] == 'IPP'){
            $stmt2 = $pdo->prepare("SELECT p.* FROM patient LEFT JOIN personneconfiance p on p.idpcon = patient.idpcon WHERE patient.ipp = ?");
            $stmt = $pdo->prepare("SELECT p2.* FROM patient LEFT JOIN personnecontacte p2 on patient.idptel = p2.idptel WHERE patient.ipp = ?");
            $stmt3 = $pdo->prepare("SELECT a.* FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE patient.ipp = ?");
            $stmt4 = $pdo->prepare("SELECT m.nom,m.prenom,m.adresse,m.ville,m.cp,p3.type,p3.lienmed FROM patient LEFT JOIN patientmedecin p3 on patient.ipp = p3.ipp LEFT JOIN medecin m on p3.idmedecin = m.idmedecin WHERE p3.ipp = ?");
            $stmt5 = $pdo->prepare("SELECT patient.* FROM patient WHERE ipp = ?");
        } else {
            $stmt2 = $pdo->prepare("SELECT p.* FROM patient LEFT JOIN personneconfiance p on p.idpcon = patient.idpcon LEFT JOIN admission a on patient.ipp = a.ipp WHERE a.iep = ?");
            $stmt = $pdo->prepare("SELECT p2.* FROM patient LEFT JOIN personnecontacte p2 on patient.idptel = p2.idptel LEFT JOIN admission a on patient.ipp = a.ipp WHERE a.iep = ?");
            $stmt3 = $pdo->prepare("SELECT a.* FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE a.iep = ?");
            $stmt4 = $pdo->prepare("SELECT m.nom,m.prenom,m.adresse,m.ville,m.cp,p3.type,p3.lienmed FROM patient LEFT JOIN patientmedecin p3 on patient.ipp = p3.ipp LEFT JOIN medecin m on p3.idmedecin = m.idmedecin LEFT JOIN admission a on patient.ipp = a.ipp WHERE a.iep = ?");
            $stmt5 = $pdo->prepare("SELECT patient.* FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE a.iep = ?");
        }
        $stmt2 -> bindParam(1,$nomPatient);
        $stmt2->execute();
        $stmt = $pdo->prepare("SELECT p2.* FROM patient LEFT JOIN personnecontacte p2 on patient.idptel = p2.idptel WHERE patient.ipp = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $stmt3 = $pdo->prepare("SELECT a.* FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE patient.ipp = ?");
        $stmt3 -> bindParam(1,$nomPatient);
        $stmt3->execute();
        $stmt4 = $pdo->prepare("SELECT m.nom,m.prenom,m.adresse,m.ville,m.cp,p3.type,p3.lienmed FROM patient LEFT JOIN patientmedecin p3 on patient.ipp = p3.ipp LEFT JOIN medecin m on p3.idmedecin = m.idmedecin WHERE patient.ipp = ?");
        $stmt4 -> bindParam(1,$nomPatient);
        $stmt4->execute();
        $stmt5 = $pdo->prepare("SELECT * FROM patient WHERE patient.ipp = ?");
        $stmt5 -> bindParam(1,$nomPatient);
        $stmt5->execute();
        $_SESSION['infosPersonneConf']=[];
        foreach ($stmt as $item){
            $_SESSION['infosPersonneConf']+=$item;
        }
        $_SESSION['infosPersonneCont']=[];
        foreach ($stmt2 as $item){
            $_SESSION['infosPersonneCont']+=$item;
        }
        $_SESSION['infosAdm']=[];
        foreach ($stmt3 as $item){
            $_SESSION['infosAdm']+=$item;
        }
        $_SESSION['infosPersonneMed']=[];
        foreach ($stmt4 as $item){
            $_SESSION['infosPersonneMed'][]=$item;
        }
        $_SESSION['infosPatient']=[];
        foreach ($stmt5 as $item){
            $_SESSION['infosPatient']+=$item;
        }

    } elseif ($nomCateg == "Observation"){
        if ($_SESSION['paramRechercheAdmi']=='IPP'){
            $stmt = $pdo->prepare("SELECT * FROM observationmedical o WHERE ipp = ?");
            $stmt2 = $pdo->prepare("SELECT * FROM transmissionsciblees o WHERE o.ipp = ?");
        } else {
            $stmt = $pdo->prepare("SELECT * FROM observationmedical o WHERE iep = ?");
            $stmt2 = $pdo->prepare("SELECT * FROM transmissionsciblees o WHERE o.iep = ?");
        }
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $stmt2 -> bindParam(1,$nomPatient);
        $stmt2->execute();
        $_SESSION['infosPatient']=[];
        $_SESSION['observationsMed']=array();
        $_SESSION['transmissionCib']=array();
        foreach ($stmt as $item){
            $_SESSION['observationsMed'][] = $item;
        }
        foreach ($stmt2 as $item){
            $_SESSION['transmissionCib'][] = $item;
        }
    } elseif ($nomCateg == "Prescription"){
        if ($_SESSION['paramRechercheAdmi']=='IPP'){
            $stmt = $pdo->prepare("SELECT prescriptionpatient.*,p.type FROM prescriptionpatient LEFT JOIN prescription p on p.idprescription = prescriptionpatient.idprescription WHERE ipp = ? ORDER BY jour");
        } else {
            $stmt = $pdo->prepare("SELECT prescriptionpatient.*,p.type FROM prescriptionpatient LEFT JOIN prescription p on p.idprescription = prescriptionpatient.idprescription WHERE iep = ? ORDER BY jour");
        }
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=array();
        foreach ($stmt as $item){
            $_SESSION['infosPatient'][]=$item;
        }
    } elseif ($nomCateg == "Intervenants"){
        if ($_SESSION['paramRechercheAdmi']=='IPP'){
            $stmt = $pdo->prepare("SELECT it.date, i.fonction, it.compterendu FROM intervention it LEFT JOIN intervenant i on i.idintervenant = it.idintervenant WHERE ipp = ? ORDER BY date");
        } else {
            $stmt = $pdo->prepare("SELECT it.date, i.fonction, it.compterendu FROM intervention it LEFT JOIN intervenant i on i.idintervenant = it.idintervenant WHERE iep = ? ORDER BY date");
        }
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=array();
        foreach ($stmt as $item){
            $_SESSION['infosPatient'][]=$item;
        }
    } elseif ($nomCateg == "Diagramme"){
        if ($_SESSION['paramRechercheAdmi']=='IPP'){
            $stmt = $pdo->prepare("SELECT * FROM soin LEFT JOIN soinpatientpredef spp on soin.idsoin = spp.idsoin LEFT JOIN soinpatient s on spp.idspp = s.idspp WHERE spp.ipp = ? ORDER BY s.jour DESC ");
        } else {
            $stmt = $pdo->prepare("SELECT * FROM soin LEFT JOIN soinpatientpredef spp on soin.idsoin = spp.idsoin LEFT JOIN soinpatient s on spp.idspp = s.idspp WHERE spp.iep = ? ORDER BY s.jour DESC ");
        }
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=array();
        foreach ($stmt as $item){
            $_SESSION['infosPatient'][]=$item;
        }
    } elseif ($nomCateg == "Biologie"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE ipp = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
        foreach ($stmt as $item){
            $_SESSION['infosPatient']+=$item;
        }
    } elseif ($nomCateg == "Imagerie"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE ipp = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
        foreach ($stmt as $item){
            $_SESSION['infosPatient']+=$item;
        }
    } elseif ($nomCateg == "Courriers"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE ipp = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
        foreach ($stmt as $item){
            $_SESSION['infosPatient']+=$item;
        }
    }
    header("Location: ../DPIpatient/DPIpatient".$nomCateg.".php");

}

function ajouterAdmissionPatient($patient,$date){
    try{
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO admission(iep,datedebut,ipp) VALUES (default,?,?)");
        $stmt2->bindParam(1, $date);
        $stmt2->bindParam(2, $patient);
        $stmt2->execute();
    } catch (Exception $e){
        ErrorMessage($e);
        die();
    }
    header(DPIReturn());
}

function DataBase_Add_Patient($IPP,$nom,$date)
{
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM patient WHERE IPP=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        if($res==1){
            header('Location: ../DPIpatient/ajouterPatient.php?erreur=2');
        }
        else{
            $stmt = $dbh->prepare("INSERT INTO patient values (?,?,?)");
            $stmt->bindParam(1, $IPP);
            $stmt->bindParam(2, $nom);
            $stmt->bindParam(3, $date);
            $stmt->execute();
            header(DPIReturn());
        }
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function DataBase_Corbeille_Patient()
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM Patient WHERE IPP=?");
        $stmt2->bindParam(1, $_SESSION["IPP_CORB"]);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        if($res==0){
            header('Location: ../DPIpatient/Corbeille.php?erreur=2');
        }
        else{
            $stmt = $dbh->prepare("insert into corbeille values (?)");
            $stmt->bindParam(1, $_SESSION["IPP_CORB"]);
            $stmt->execute();
            header(DPIReturn());
        }
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function Check_Patient($IPP)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM Patient WHERE IPP=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        return $stmt2->fetchColumn(0);

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function ADD_Image_Bio($IPP,$nom,$lien,$des)
{

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO Biologie values (?,?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);
        $stmt2->bindParam(4,$des);
        $stmt2->execute();

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function ADD_Image_Cour($IPP,$nom,$lien)
{

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO couriel values (?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);
        $stmt2->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function ADD_Image_Rad($IPP,$nom,$lien)
{

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO radio values (?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);
        $stmt2->execute();

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}
function Check_Image_Imagerie($IPP,$nomIma)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM radio WHERE IPPRadio=? and lien=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->bindParam(2,$nomIma);
        $stmt2->execute();
        return $stmt2->fetchColumn(0);

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function Check_Image_Biologie($IPP,$nomIma)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM Biologie WHERE IPPBio=? and lien=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->bindParam(2,$nomIma);
        $stmt2->execute();
        return $stmt2->fetchColumn(0);

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function Delete_Image_Courriel($nomIma)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("DELETE FROM couriel WHERE lien=? ");
        $stmt2->bindParam(1,$nomIma);
        $stmt2->execute();

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function Delete_Image_Imagerie($nomIma)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("DELETE FROM radio WHERE lien=? ");
        $stmt2->bindParam(1,$nomIma);
        $stmt2->execute();

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function Delete_Image_Biologie($nomIma)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("DELETE FROM Biologie WHERE lien=? ");
        $stmt2->bindParam(1,$nomIma);
        $stmt2->execute();

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function Check_Image_Courriel($IPP,$nomIma)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM couriel WHERE IPPCour=? and lien=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->bindParam(2,$nomIma);
        $stmt2->execute();
        return $stmt2->fetchColumn(0);

    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function DataBase_Delete_Corbeille($ipp)
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select count(*) from corbeille WHERE IPPCorb=?");
        $stmt2->bindParam(1, $ipp);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        if($res==0){
            header('Location: ../DPIpatient/RecupCorbeille.php?erreur=2');
        }
        else{
            $stmt = $dbh->prepare("DELETE FROM corbeille WHERE IPPCorb=?");
            $stmt->bindParam(1, $ipp);
            $stmt->execute();
            header(DPIReturn());
        }
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function DataBase_Delete_Patient()
{
    session_start();

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select count(*) from corbeille WHERE IPPCorb=?");
        $stmt2->bindParam(1, $_SESSION["IPP_SUPP"]);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        if($res==0){
            header('Location: ../DPIpatient/SupprimerPatient.php?erreur=2');
        }
        else{
            $stmt = $dbh->prepare("DELETE FROM patient WHERE IPP=?");
            $stmt->bindParam(1, $_SESSION["IPP_SUPP"]);
            $stmt->execute();
            header(DPIReturn());
        }
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function DataBase_Attribute_Role($ID,$Role)
{
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
        $stmt->bindParam(1, $ID);
        $stmt->execute();
        $result = $stmt->fetchColumn(0);

        if($result==1){

            try {
                $dbh = $dbh = DataBase_Creator_Uit();
                $stmt = $dbh->prepare("UPDATE utilisateur SET roles=? WHERE login=?");
                $stmt->bindParam(1, $Role);
                $stmt->bindParam(2, $ID);

                $stmt->execute();
                header('Location: ../DPIpatient/DPI.php');
            } catch (PDOException $e) {
                ErrorMessage($e);
                die();
            }
        }

        else{
            header('Location: ../DPIpatient/AttributionRole.php?erreur=1');
        }
    }catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function VisuImagerie($IPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select lien from radio where IPPRadio=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        return $stmt2->fetchAll(PDO::FETCH_COLUMN, 0);
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function VisuBio($IPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select lien,nom,description from Biologie where IPPBio=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        $res = [];
        foreach ($stmt2 as $r){
            $res[] = $r;
        }
        return $res;
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

function VisuCour($IPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select lien from couriel where IPPCour=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        return $stmt2->fetchAll(PDO::FETCH_COLUMN, 0);
    } catch (PDOException $e) {
        ErrorMessage($e);
        die();
    }
}

// Separation
function verification($elt){
    if (empty($elt)) {
        $elt = 'rien';
    }
    return $elt;
}

function Contact($PDO){
    $idContact = $PDO->prepare("SELECT max(idptel) from personnecontacte");
    $idContact->execute();
    foreach ($idContact as $idcont) {
        return $idcont[0] + 1;
    }
}

function Confiant($PDO){
    $idConfiance = $PDO->prepare("SELECT max(idpcon) from personneconfiance");
    $idConfiance->execute();
    foreach ($idConfiance as $idconf) {
        return $idconf[0] + 1;
    }
}

function getLstIPP(){
    $PDO = DataBase_Creator_Unit();
    $ipp = $PDO->prepare("Select ipp from patient");
    $ipp->execute();
    $lstipp = [];
    foreach ($ipp as $ipps) {
        $lstipp[] = $ipps[0];
    }
    return $lstipp;
}

function PatientIEP($PDO)
{
    $idPatientIep = $PDO->prepare("SELECT max(iep)from patient");
    $idPatientIep->execute();
    foreach ($idPatientIep as $idpatIep) {
        return $idpatIep[0] + 1;
    }
}

function AjouterDPI ()
{
    $PDO = DataBase_Creator_Unit();
    $contacte1 = Contact($PDO);
    $Contacte = $PDO->prepare("insert into personnecontacte (idptel, nom, prenom, telephone, lien) VALUES (?,?,?,?,?)");
    $Contacte->bindParam(1, $contacte1);
    $Contacte->bindParam(2, $_POST['nomct']); // Permets de récupérer le nom du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(3, $_POST['prenomct']); // Permets de récupérer le prénom du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(4, $_POST['telephonect']); // Permets de récupérer le téléphone du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(5, $_POST['lienct']); // Permets de récupérer le lien de parenté du contact de la personne saisi dans le formulaire
    $Contacte->execute();


    $confiance1 = Confiant($PDO);
    $boo = "true";
    $Confiance = $PDO->prepare("insert into personneconfiance (idpcon, nom, prenom, telephone, lien, formulaire) VALUES (?,?,?,?,?,?)");
    $Confiance->bindParam(1, $confiance1);
    $Confiance->bindParam(2, $_POST['nomcf']); // Permets de récupérer le nom de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(3, $_POST['prenomcf']); // Permets de récupérer le prénom de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(4, $_POST['telephonecf']); // Permets de récupérer le téléphone de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(5, $_POST['liencf']); // Permets de récupérer le lien de parenté de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(6, $boo);
    $Confiance->execute();


    $patientiep = PatientIEP($PDO);
    // Permet d'ajouter des informations dans la base de données //
    $Patient1 = $PDO->prepare("insert into patient (ipp, iep, nom, prenom, date_de_naissance, taille_cm, poids_kg, adresse, code_postal, ville, telephone_personnel, telephone_professionnel, allergies, antecedents, obstericaux, documents_medicaux, documents_chirurgicaux, idpcon, idptel, mesure_de_protection, assistant_social, mode_de_vie, synthese_entree, traitement_domicile, donnee_physique_psychologique, mobilite, alimentation, hygiene, toilette, habit, continence)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $Patient1->bindParam(1, $_POST['ipp']);
    $Patient1->bindParam(2, $patientiep);
    $Patient1->bindParam(3, $_POST['nom']); // Permets de récupérer le nom saisi dans le formulaire
    $Patient1->bindParam(4, $_POST['prenom']); // Permets de récupérer le prénom saisi dans le formulaire
    $Patient1->bindParam(5, $_POST['date_de_naissance']); // Permets de récupérer la date de naissance saisie dans le formulaire
    $Patient1->bindParam(6, $_POST['taille_cm']); // Permets de récupérer la taille saisie dans le formulaire
    $Patient1->bindParam(7, $_POST['poids_kg']); // Permets de récupérer le poids saisi dans le formulaire
    $Patient1->bindParam(8, $_POST['adresse']); // Permets de récupérer l'adresse saisie dans le formulaire
    $Patient1->bindParam(9, $_POST['code_postal']); // Permets de récupérer le code postal saisi dans le formulaire
    $Patient1->bindParam(10, $_POST['ville']); // Permets de récupérer la ville saisie dans le formulaire
    $Patient1->bindParam(11, $_POST['telephone_personnel']); // Permets de récupérer le telperso saisi dans le formulaire
    $telpro = verification($_POST['telephone_professionnel']); // Permets de vérifier si le telpro est bien saisi
    $Patient1->bindParam(12, $telpro);
    $allergies = verification($_POST['allergies']); // Permets de vérifier si les allergies sont bien saisi
    $Patient1->bindParam(13, $allergies);
    $antecedents = verification($_POST['antecedents']); // Permets de vérifier si les antécédents sont bien saisi
    $Patient1->bindParam(14, $antecedents);
    $Obs = verification($_POST['obstericaux']); // Permets de vérifier si les Obs sont bien saisi
    $Patient1->bindParam(15, $Obs);
    $docMed = verification($_POST['documents_medicaux']); // Permets de vérifier si les docMed sont bien saisi
    $Patient1->bindParam(16, $docMed);
    $docChir = verification($_POST['documents_chirurgicaux']); // Permets de vérifier si les docChir sont bien saisi
    $Patient1->bindParam(17, $docChir);
    $Patient1->bindParam(18, $confiance1);
    $Patient1->bindParam(19, $contacte1);
    $Patient1->bindParam(20, $_POST['mesure_de_protection']); // Permets de récuperer les MP saisi dans le formulaire
    $Patient1->bindParam(21, $_POST['assistant_social']); // Permets de récupérer les AC saisi dans le formulaire
    $MDV = verification($_POST['mode_de_vie']);
    $Patient1->bindParam(22, $MDV);
    $Patient1->bindParam(23, $_POST['synthese_entree']); // Permets de récupérer la synEntree saisi dans le formulaire
    $tradomi = verification($_POST['traitement_domicile']); // Permets de vérifier si tradomi est bien saisi
    $Patient1->bindParam(24, $tradomi);
    $doPhyPsy = verification($_POST['donnee_physique_psychologique']); // Permets de vérifier si doPhyPsy est bien saisi
    $Patient1->bindParam(25, $doPhyPsy);
    $Patient1->bindParam(26, $_POST['mobilite']); // Permets de récupérer CD saisi dans le formulaire
    $Patient1->bindParam(27, $_POST['alimentation']); // Permets de récupérer CM saisi dans le formulaire
    $Patient1->bindParam(28, $_POST['hygiene']); // Permets de récupérer CL saisi dans le formulaire
    $Patient1->bindParam(29, $_POST['toilette']); // Permets de récupérer CT saisi dans le formulaire
    $Patient1->bindParam(30, $_POST['habit']); // Permets de récupérer CH saisi dans le formulaire
    $Patient1->bindParam(31, $_POST['continence']); // Permets de récupérer conti saisie dans le formulaire
    $Patient1->execute();

}

function StockDPI ()
{
    $DPI1 = DataBase_Creator_Unit();
    $DPI = $DPI1->prepare("Select * from Patient where ipp = ?");
    $DPI->bindParam(1, $_POST['recherche']);
    $DPI->execute();
    foreach ($DPI as $info) {
        return $info;
    }
}

function lstderoulante(){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("Select ipp, nom, prenom from Patient left join Corbeille C on Patient.IPP = C.IPPCorb WHERE IPPCorb is null");
    $DPI->execute();
    return $DPI;
}

function lstderoulante2(){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("Select ipp, nom, prenom from Patient");
    $DPI->execute();
    return $DPI;
}

function lstderoulanteCorb(){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("Select ipp, nom, prenom from Patient left join Corbeille C on Patient.IPP = C.IPPCorb WHERE IPPCorb is not null");
    $DPI->execute();
    return $DPI;
}

function lstderoulanteImageBio($ipp){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select lien,nom,IPPBio from biologie where IPPBio= ?");
    $DPI->bindParam(1,$ipp);
    $DPI->execute();
    return $DPI->fetchAll(PDO::FETCH_COLUMN, 1);
}

function lstderoulanteImageRad($ipp){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select lien,nom,IPPRadio from radio where IPPRadio= ?");
    $DPI->bindParam(1,$ipp);
    $DPI->execute();
    return $DPI->fetchAll(PDO::FETCH_COLUMN, 1);
}

function lstderoulanteImageCou($ipp){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select lien,nom,IPPCour from couriel where IPPCour= ?");
    $DPI->bindParam(1,$ipp);
    $DPI->execute();
    return $DPI->fetchAll(PDO::FETCH_COLUMN, 1);
}

function nameColonne ($tablesql){
    $DPI3 = DataBase_Creator_Unit();
    $colonne = $DPI3->prepare("SELECT column_name, data_type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? order by ordinal_position");
    $table = $tablesql;
    $colonne->bindParam(1,$table);
    $colonne->execute();
    $donnees = [];
    $typedonnees = [];
    foreach ($colonne as $don){
        $donnees[] = $don[0];
        $typedonnees[] = $don[1];;
    }
    return [$donnees,$typedonnees];
}


function modifier($ipp){
    $DPI3 = DataBase_Creator_Unit();
    $MDF = $DPI3->prepare("UPDATE patient set iep = ?, nom = ? , prenom = ? , date_de_naissance = ? , taille_cm = ? , poids_kg = ?, adresse = ?, code_postal = ?, ville = ?, telephone_personnel = ?, telephone_professionnel = ?,allergies = ?, antecedents = ?, obstericaux = ?, documents_medicaux = ?, documents_chirurgicaux = ?, mesure_de_protection = ?,
                   assistant_social = ?, mode_de_vie = ?, synthese_entree = ?, traitement_domicile = ?, donnee_physique_psychologique = ?, mobilite = ?, alimentation = ?, hygiene = ?, toilette = ?, habit = ? where ipp = ?;
");
    $MDF->bindParam(1,$_POST['iep']);
    $MDF->bindParam(2, $_POST['nom']);
    $MDF->bindParam(3, $_POST['prenom']);
    $MDF->bindParam(4, $_POST['date_de_naissance']);
    $MDF->bindParam(5, $_POST['taille_cm']);
    $MDF->bindParam(6, $_POST['poids_kg']);
    $MDF->bindParam(7, $_POST['adresse']);
    $MDF->bindParam(8, $_POST['code_postal']);
    $MDF->bindParam(9, $_POST['ville']);
    $MDF->bindParam(10, $_POST['telephone_personnel']);
    $MDF->bindParam(11, $_POST['telephone_professionnel']);
    $MDF->bindParam(12, $_POST['allergies']);
    $MDF->bindParam(13, $_POST['antecedents']);
    $MDF->bindParam(14, $_POST['obstericaux']);
    $MDF->bindParam(15, $_POST['documents_medicaux']);
    $MDF->bindParam(16, $_POST['documents_chirurgicaux']);
    $MDF->bindParam(17, $_POST['mesure_de_protection']);
    $MDF->bindParam(18, $_POST['assistant_social']);
    $MDF->bindParam(19, $_POST['mode_de_vie']);
    $MDF->bindParam(20, $_POST['synthese_entree']);
    $MDF->bindParam(21, $_POST['traitement_domicile']);
    $MDF->bindParam(22, $_POST['donnee_physique_psychologique']);
    $MDF->bindParam(23, $_POST['mobilite']);
    $MDF->bindParam(24, $_POST['alimentation']);
    $MDF->bindParam(25, $_POST['hygiene']);
    $MDF->bindParam(26, $_POST['toilette']);
    $MDF->bindParam(27, $_POST['habit']);
    $MDF->bindParam(28, $ipp);
    $MDF->execute();

}




// Separation

function DPIReturn()
{
    return 'Location: ../DPIpatient/DPI.php';
}

function ErrorMessage($e)
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
}

function Modif_Observation($date,$init,$cible,$donn,$act,$res){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("INSERT INTO transmissionsciblees VALUES (default,?,?,?,?,?,?,?,?);");
        $stmt -> bindParam(1,$date);
        $stmt ->bindParam(2,$init);
        $stmt -> bindParam(3,$cible);
        $stmt -> bindParam(4,$donn);
        $stmt -> bindParam(5,$act);
        $stmt -> bindParam(6,$res);
        $stmt -> bindParam(7,$_SESSION['infosPersoPatient']['ipp']);
        $stmt -> bindParam(8,$_SESSION['infosPersoPatient']['iep']);
        $stmt -> execute();
        header("Location: ../DPIpatient/DPIpatientObservation.php");
    } catch (PDOException $e){
        print "Erreur :".$e->getMessage()."<br>";
        die();
    }
}

function Modif_Prescription($traitement,$type,$v){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt1 = $dbh->prepare("SELECT idprescription FROM prescription WHERE nom = ?");
        $stmt1->execute();
        $idPrescription = $stmt1->fetchColumn(0) ?? "aucun";
        if ($idPrescription == "aucun"){
            $createPrescription = $dbh->prepare("INSERT INTO prescription VALUES (default,?,?)");
            $createPrescription->bindParam(1,$traitement);
            $createPrescription->bindParam(2,$type);
            $createPrescription->execute();
            $id = $dbh->lastInsertId();
        }
        $stmt = $dbh->prepare("INSERT INTO prescriptionpatient VALUES (default,?,?,?,?,?,?,?,?);");
        $stmt -> bindParam(1,$date);
        $stmt ->bindParam(2,$v);
        $stmt -> bindParam(3,$cible);
        $stmt -> bindParam(4,$traitement);
        $stmt -> bindParam(5,$fait);
        $stmt -> bindParam(6,$_SESSION['infosPersoPatient']['ipp']);
        $stmt -> bindParam(7,$id);
        $stmt -> bindParam(8,$_SESSION['infosPersoPatient']['iep']);
        $stmt -> execute();
        header("Location: ../DPIpatient/DPIpatientObservation.php");
    } catch (PDOException $e){
        print "Erreur :".$e->getMessage()."<br>";
        die();
    }
}


?>
