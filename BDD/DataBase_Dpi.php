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
        $stmt = $dbh->prepare("SELECT IPP, nom FROM patient WHERE nom like ? LIMIT ? OFFSET ?");
        $stmt->bindParam(1,$rm);
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(2,$lim);
        $stmt->bindParam(3,$_SESSION['incrPat']);
        $stmt->execute();
    }
    if ($p=='Date hospitalisation' && $rm=='aucun') {
        $stmt = $dbh->prepare("SELECT patient.ipp,nom FROM patient JOIN admission ON admission.idadmission = patient.iep ORDER BY admission LIMIT ? OFFSET ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient ORDER BY nom LIMIT ? OFFSET ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->bindParam(2,$_SESSION['incrPat']);
        $stmt->execute();
    } elseif($rm=='aucun') {
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient LIMIT ? OFFSET ?");
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
    header('Location: ../DPIpatient/DPI.php');
}

function Data_Patient_Querry($nomPatient, $nomCateg){
    $pdo = DataBase_Creator_Unit();
    $info = $pdo->prepare("SELECT patient.ipp, iep, nom, prenom, ddn, ville, poids_kg, taille_cm, datedebut, datefin FROM patient LEFT JOIN admission a on patient.ipp = a.ipp WHERE patient.nom = ?");
    $info -> bindParam(1,$nomPatient);
    $info->execute();
    $_SESSION['infosPersoPatient']=[];
    foreach ($info as $item){
        $_SESSION['infosPersoPatient']+=$item;
    }
    if ($nomCateg == "Macrocible"){
        $stmt = $pdo->prepare("SELECT * FROM patient LEFT JOIN personneconfiance p on patient.idpcon = p.idpcon LEFT JOIN personnecontacte p2 on patient.idptel = p2.idptel LEFT JOIN admission a on patient.ipp = a.ipp LEFT JOIN patientmedecin p3 on patient.ipp = p3.ipp WHERE patient.nom = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];

    } elseif ($nomCateg == "Observation"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE patient.nom = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
    } elseif ($nomCateg == "Prescription"){
        $stmt = $pdo->prepare("SELECT * FROM prescriptionpatient WHERE ipp = ? ORDER BY jour");
        $stmt -> bindParam(1,$_SESSION['infosPersoPatient']['ipp']);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
    } elseif ($nomCateg == "Diagramme"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE nom = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
    } elseif ($nomCateg == "Biologie"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE nom = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
    } elseif ($nomCateg == "Imagerie"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE nom = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
    } elseif ($nomCateg == "Courriers"){
        $stmt = $pdo->prepare("SELECT * FROM patient WHERE nom = ?");
        $stmt -> bindParam(1,$nomPatient);
        $stmt->execute();
        $_SESSION['infosPatient']=[];
    }
    $_SESSION['infosPatient']=array();
    $donn = array();
    foreach ($stmt as $item){
        $donn+=$item;
    }
    $_SESSION['infosPatient'] -> push($donn);

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

function DataBase_Delete_Patient()
{
    session_start();
    
    try {
        $dbh = $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM patient WHERE IPP=?");
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

?>
