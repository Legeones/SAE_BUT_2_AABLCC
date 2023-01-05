<?php

require('../BDD/DataBase_Core.php');


function Patient_Parcour($p,$rm,$rma): void
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
            $stmt = $dbh->prepare("SELECT patient.IPP, nom FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb WHERE nom like ? and IPPCorb is null LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.IPP, nom FROM patient left join admission on patient.ipp = admission.ipp left join Corbeille C on Patient.IPP = C.IPPCorb WHERE nom like ? and IPPCorb is null ORDER BY iep DESC LIMIT ? OFFSET ?");
        }
        $stmt->bindParam(1,$rm);
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(2,$lim);
        $stmt->bindParam(3,$_SESSION['incrPat']);
        $stmt->execute();
    }
    if ($p=='Date hospitalisation' && $rm=='aucun') {
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT patient.ipp,nom FROM patient JOIN admission ON admission.ipp = patient.ipp  left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.ipp,nom FROM patient JOIN admission ON admission.ipp = patient.ipp  left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is  null ORDER BY admission.iep DESC LIMIT ? OFFSET ?");
        }
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT patient.IPP,nom FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null ORDER BY nom LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.IPP,nom FROM patient left join admission on patient.ipp = admission.ipp left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null ORDER BY nom, admission.iep LIMIT ? OFFSET ?");
        }
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif($rm=='aucun') {
        if ($rma == 'IPP'){
            $stmt = $dbh->prepare("SELECT patient.IPP,nom FROM patient left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null LIMIT ? OFFSET ?");
        } else if ($rma == 'IEP'){
            $stmt = $dbh->prepare("SELECT admission.iep,patient.IPP,nom FROM patient left join admission on patient.ipp = admission.ipp left join Corbeille C on Patient.IPP = C.IPPCorb where IPPCorb is null ORDER BY admission.iep LIMIT ? OFFSET ?");
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
    header('Location: ../DPIpatient/DPI.php');
}

function Data_Patient_Querry($nomPatient, $nomCateg){
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
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $stmt3 -> bindParam(1,$nomPatient);
        $stmt3->execute();
        $stmt4 -> bindParam(1,$nomPatient);
        $stmt4->execute();
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
            header('Location: ../DPIpatient/DPI.php');
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
            header('Location: ../DPIpatient/DPI.php');
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        $res= $stmt2->fetchColumn(0);
        return $res;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function ADD_Image_Bio($IPP,$nom,$lien,$des,$til)
{

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO Biologie values (?,?,?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);
        $stmt2->bindParam(4,$des);
        $stmt2->bindParam(5,$til);
        //$stmt2->bindParam(4,$_SESSION['infosPersoPatient']['iep']);
        $stmt2->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function ADD_Image_Cour($IPP,$nom,$lien)
{

    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO couriel values (?,?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);
        $stmt2->bindParam(4,$_SESSION['infosPersoPatient']['iep']);
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
        $stmt2 = $dbh->prepare("INSERT INTO radio values (?,?,?,?)");
        $stmt2->bindParam(1, $lien);
        $stmt2->bindParam(2, $nom);
        $stmt2->bindParam(3, $IPP);$stmt2->bindParam(4,$_SESSION['infosPersoPatient']['iep']);
        $stmt2->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        $res= $stmt2->fetchColumn(0);
        return $res;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        $res= $stmt2->fetchColumn(0);
        return $res;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
        $res= $stmt2->fetchColumn(0);
        return $res;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
            header('Location: ../DPIpatient/DPI.php');
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
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
            header('Location: ../DPIpatient/DPI.php');
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function DataBase_Attribute_Role($ID,$Role)
{
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
        $stmt->bindParam(1, $_POST["ID"]);
        $stmt->execute();
        $result = $stmt->fetchColumn(0);

        if($result==1){

            try {
                $dbh = $dbh = DataBase_Creator_Unit();
                $stmt = $dbh->prepare("UPDATE utilisateur SET roles=? WHERE login=?");
                $stmt->bindParam(1, $_POST["Role"]);
                $stmt->bindParam(2, $_POST["ID"]);

                $stmt->execute();
                header('Location: ../DPIpatient/DPI.php');
            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        else{
            header('Location: ../DPIpatient/AttributionRole.php?erreur=1');
        }
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function VisuImagerie($IPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select lien from radio where ippradio=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        $result = $stmt2->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
        //echo "<img class='logo' src=$res>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function VisuBio($IPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select lien from Biologie where IPPBio=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        $result = $stmt2->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
        //echo "<img class='logo' src=$res>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function VisuCour($IPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("select lien from couriel where IPPCour=?");
        $stmt2->bindParam(1, $IPP);
        $stmt2->execute();
        $result = $stmt2->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
        //echo "<img class='logo' src=$res>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
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
