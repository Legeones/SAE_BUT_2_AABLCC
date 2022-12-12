<?php

require('../BDD/DataBase_Core.php');


function Patient_Parcour($p,$rm){
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
        $stmt = $dbh->prepare("SELECT IPP, nom FROM patient  left join Corbeille C on Patient.IPP = C.IPPCorb WHERE nom like ? and IPPCorb is null LIMIT ? OFFSET ?");
        $stmt->bindParam(1,$rm);
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(2,$lim);
        $stmt->bindParam(3,$_SESSION['incrPat']);
        $stmt->execute();
    }
    
    if ($p=='Date hospitalisation' && $rm=='aucun') {
        $stmt = $dbh->prepare("SELECT patient.ipp,nom FROM patient JOIN admission ON admission.idadmission = patient.iep  left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is  null ORDER BY admission LIMIT ? OFFSET ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null ORDER BY nom LIMIT ? OFFSET ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif($rm=='aucun') {
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient  left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null LIMIT ? OFFSET ?");
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
            $_SESSION['np'] = "patient".$i;
            $_SESSION[$_SESSION['np']] = $p;
            $i = $i+1;
        }
    }
    header(DPIReturn());
}

function Data_Patient_Querry($nomPatient, $nomCateg){
    $pdo = DataBase_Creator_Unit();
    $info = $pdo->prepare("SELECT patient.ipp, iep, nom, prenom, ddn, ville, poids_kg, taille_cm, datedebut, datefin FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE patient.ipp = ?");
    $info -> bindParam(1,$nomPatient);
    $info->execute();
    $_SESSION['infosPersoPatient']=[];
    foreach ($info as $item){
        $_SESSION['infosPersoPatient']+=$item;
    }
    if ($nomCateg == "Macrocible"){
        $stmt2 = $pdo->prepare("SELECT p.* FROM patient LEFT JOIN personneconfiance p on p.idpcon = patient.idpcon WHERE ipp = ?");
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
        $stmt = $pdo->prepare("SELECT * FROM observationmedical o WHERE o.ipp = ?");
        $stmt2 = $pdo->prepare("SELECT * FROM transmissionsciblees o WHERE o.ipp = ?");
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
        $stmt = $pdo->prepare("SELECT * FROM prescriptionpatient WHERE ipp = ? ORDER BY jour");
        $stmt -> bindParam(1,$_SESSION['infosPersoPatient']['ipp']);
        $stmt->execute();
        $_SESSION['infosPatient']=array();
        foreach ($stmt as $item){
            $_SESSION['infosPatient'][]=$item;
        }
    } elseif ($nomCateg == "Intervenants"){
        $stmt = $pdo->prepare("SELECT it.date, i.fonction, it.compterendu FROM intervention it LEFT JOIN intervenant i on i.idintervenant = it.idintervenant WHERE ipp = ? ORDER BY date");
        $stmt -> bindParam(1,$_SESSION['infosPersoPatient']['ipp']);
        $stmt->execute();
        $_SESSION['infosPatient']=array();
        foreach ($stmt as $item){
            $_SESSION['infosPatient'][]=$item;
        }
    } elseif ($nomCateg == "Diagramme"){
        $stmt = $pdo->prepare("SELECT * FROM soinpatient LEFT JOIN soin s on s.idsoin = soinpatient.idsoin WHERE ipp = ? ORDER BY jour DESC ");
        $stmt -> bindParam(1,$_SESSION['infosPersoPatient']['ipp']);
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

function ADD_Image_Bio($IPP,$nom,$lien)
{

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO Biologie values (?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);
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
        $stmt2 = $dbh->prepare("select lien from Biologie where IPPBio=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        return $stmt2->fetchAll(PDO::FETCH_COLUMN, 0);
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

function PatientIPP($PDO){
    $idPatientIpp = $PDO->prepare("SELECT max(ipp)from patient");
    $idPatientIpp->execute();
    foreach ($idPatientIpp as $idpatIpp) {
        return $idpatIpp[0] + 1;
    }
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
    $Contacte = $PDO->prepare("insert into personnecontacte (idptel, nom, prenom, tel, lien) VALUES (?,?,?,?,?)");
    $Contacte->bindParam(1, $contacte1);
    $Contacte->bindParam(2, $_POST['nomCT']); // Permets de récupérer le nom du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(3, $_POST['prenomCT']); // Permets de récupérer le prénom du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(4, $_POST['telCT']); // Permets de récupérer le téléphone du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(5, $_POST['lienCT']); // Permets de récupérer le lien de parenté du contact de la personne saisi dans le formulaire
    $Contacte->execute();
    
    
    $confiance1 = Confiant($PDO);
    $boo = "true";
    $Confiance = $PDO->prepare("insert into personneconfiance (idpcon, nom, prenom, tel, lien, formulaire) VALUES (?,?,?,?,?,?)");
    $Confiance->bindParam(1, $confiance1);
    $Confiance->bindParam(2, $_POST['nomC']); // Permets de récupérer le nom de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(3, $_POST['prenomC']); // Permets de récupérer le prénom de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(4, $_POST['telC']); // Permets de récupérer le téléphone de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(5, $_POST['lienC']); // Permets de récupérer le lien de parenté de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(6, $boo);
    $Confiance->execute();
    
    
    $patientipp = PatientIPP($PDO);
    $patientiep = PatientIEP($PDO);
    // Permet d'ajouter des informations dans la base de données //
    $Patient1 = $PDO->prepare("insert into patient (ipp, iep, nom, prenom, ddn, taille_cm, poids_kg, adresse, cp, ville, telpersonnel, telprofessionnel, allergies, antecedents, obstericaux, domedicaux, dochirurgicaux, idpcon, idptel, mesuredeprotection, asistantsocial, mdv, synentre, traidomi, dophypsy, mobilite, alimentation, hygiene, toilette, habit, continence)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $Patient1->bindParam(1, $patientipp);
    $Patient1->bindParam(2, $patientiep);
    $Patient1->bindParam(3, $_POST['nom']); // Permets de récupérer le nom saisi dans le formulaire
    $Patient1->bindParam(4, $_POST['prenom']); // Permets de récupérer le prénom saisi dans le formulaire
    $Patient1->bindParam(5, $_POST['DDN']); // Permets de récupérer la date de naissance saisie dans le formulaire
    $Patient1->bindParam(6, $_POST['taille']); // Permets de récupérer la taille saisie dans le formulaire
    $Patient1->bindParam(7, $_POST['poids']); // Permets de récupérer le poids saisi dans le formulaire
    $Patient1->bindParam(8, $_POST['adresse']); // Permets de récupérer l'adresse saisie dans le formulaire
    $Patient1->bindParam(9, $_POST['CP']); // Permets de récupérer le code postal saisi dans le formulaire
    $Patient1->bindParam(10, $_POST['ville']); // Permets de récupérer la ville saisie dans le formulaire
    $Patient1->bindParam(11, $_POST['telperso']); // Permets de récupérer le telperso saisi dans le formulaire
    $telpro = verification($_POST['telpro']); // Permets de vérifier si le telpro est bien saisi
    $Patient1->bindParam(12, $telpro);
    $allergies = verification($_POST['allergies']); // Permets de vérifier si les allergies sont bien saisi
    $Patient1->bindParam(13, $allergies);
    $antecedents = verification($_POST['antecedents']); // Permets de vérifier si les antécédents sont bien saisi
    $Patient1->bindParam(14, $antecedents);
    $Obs = verification($_POST['Obs']); // Permets de vérifier si les Obs sont bien saisi
    $Patient1->bindParam(15, $Obs);
    $docMed = verification($_POST['docMed']); // Permets de vérifier si les docMed sont bien saisi
    $Patient1->bindParam(16, $docMed);
    $docChir = verification($_POST['docChir']); // Permets de vérifier si les docChir sont bien saisi
    $Patient1->bindParam(17, $docChir);
    $Patient1->bindParam(18, $confiance1);
    $Patient1->bindParam(19, $contacte1);
    $Patient1->bindParam(20, $_POST['MP']); // Permets de récuperer les MP saisi dans le formulaire
    $Patient1->bindParam(21, $_POST['AC']); // Permets de récupérer les AC saisi dans le formulaire
    $MDV = verification($_POST['MDV']);
    $Patient1->bindParam(22, $MDV);
    $Patient1->bindParam(23, $_POST['synEntree']); // Permets de récupérer la synEntree saisi dans le formulaire
    $tradomi = verification($_POST['tradomi']); // Permets de vérifier si tradomi est bien saisi
    $Patient1->bindParam(24, $tradomi);
    $doPhyPsy = verification($_POST['doPhyPsy']); // Permets de vérifier si doPhyPsy est bien saisi
    $Patient1->bindParam(25, $doPhyPsy);
    $Patient1->bindParam(26, $_POST['CD']); // Permets de récupérer CD saisi dans le formulaire
    $Patient1->bindParam(27, $_POST['CM']); // Permets de récupérer CM saisi dans le formulaire
    $Patient1->bindParam(28, $_POST['CL']); // Permets de récupérer CL saisi dans le formulaire
    $Patient1->bindParam(29, $_POST['CT']); // Permets de récupérer CT saisi dans le formulaire
    $Patient1->bindParam(30, $_POST['CH']); // Permets de récupérer CH saisi dans le formulaire
    $Patient1->bindParam(31, $_POST['conti']); // Permets de récupérer conti saisie dans le formulaire
    $Patient1->execute();
    
    // Permet d'afficher null dans la base de données si des informations ne sont pas renseignés //
    $_SESSION['nomp'] = null;
    $_SESSION['prenomp'] = null;
    $_SESSION['DDNp'] = null;
    $_SESSION['taillep'] = null;
    $_SESSION['poidsp'] = null;
    $_SESSION['adressep'] = null;
    $_SESSION['CPp'] = null;
    $_SESSION['villep'] = null;
    $_SESSION['telpersop'] = null;
    $_SESSION['telprop'] = null;
    $_SESSION['allergiesp'] = null;
    $_SESSION['antecedentsp'] = null;
    $_SESSION['Obsp'] = null;
    $_SESSION['docMedp'] = null;
    $_SESSION['docChirp'] = null;
    $_SESSION['MPp'] = null;
    $_SESSION['ACp'] = null;
    $_SESSION['MDVp'] = null;
    $_SESSION['synEntreep'] = null;
    $_SESSION['tradomip'] = null;
    $_SESSION['doPhyPsyp'] = null;
    $_SESSION['CDp'] = null;
    $_SESSION['CMp'] = null;
    $_SESSION['CLp'] = null;
    $_SESSION['CTp'] = null;
    $_SESSION['CHp'] = null;
    $_SESSION['contip'] = null;
    
    
    $_SESSION['nomCTp'] = null;
    $_SESSION['prenomCTp'] = null;
    $_SESSION['telCTp'] = null;
    $_SESSION['lienCTp'] = null;
    
    $_SESSION['nomCp'] = null;
    $_SESSION['prenomCp'] = null;
    $_SESSION['telCp'] = null;
    $_SESSION['lienCp'] = null;
    
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

function nameColonne (){
    $DPI3 = DataBase_Creator_Unit();
    $colonne = $DPI3->prepare("SELECT column_name, data_type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? order by ordinal_position");
    $table = 'patient';
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
// Separation

function DPIReturn()
{
    return 'Location: ../DPIpatient/DPI.php';
}

function ErrorMessage($e)
{
    print "Erreur !: " . $e->getMessage() . "<br/>";
}
?>
