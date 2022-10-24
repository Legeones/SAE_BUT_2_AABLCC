<?php

require('../BDD/DataBase_Core.php');

function DataBase_Change($p,$rm){
    $o = 1;
    if($_SESSION['patient1']!=null){
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
        $stmt = $dbh->prepare("SELECT IPP, nom FROM patient WHERE nom like ? LIMIT ?");
        $stmt->bindParam(1,$rm);
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(2,$lim);
        $stmt->execute();
    }
    if ($p=='Date hospitalisation' && $rm=='aucun') {
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient ORDER BY admission LIMIT ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->execute();
    } elseif ($p=='Ordre alphabetique' && $rm=='aucun'){
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient ORDER BY nom LIMIT ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->execute();
    } elseif($rm=='aucun') {
        $stmt = $dbh->prepare("SELECT IPP,nom FROM patient LIMIT ?");
        $lim = $_SESSION['incrPat']+25;
        $stmt->bindParam(1,$lim);
        $stmt->execute();
    }
    return $stmt;
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
                header('Location: login.php');
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
