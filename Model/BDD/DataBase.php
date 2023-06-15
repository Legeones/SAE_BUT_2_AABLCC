<?php
//Connexion à la base de données// // Veuiller Aligner par rapport au autre fichier du repertoire S.V.P. //
require ('DataBase_Core.php');

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
        header('Location: ../../Vue/DPIPatient/DPI.php');
    }



/**
 * @param $nomPatient
 * @param $nomCateg
 * @return void
 */
function Data_Patient_Querry($nomPatient, $nomCateg){
        $pdo = DataBase_Creator_Unit();
        $requestlambda = "SELECT * FROM patient WHERE ?";
        if ($nomCateg == "macrocible"){
            $stmt = $pdo->prepare("SELECT * FROM patient LEFT JOIN personneconfiance p on patient.idpcon = p.idpcon LEFT JOIN personnecontacte p2 on patient.idptel = p2.idptel LEFT JOIN admission a on patient.ipp = a.ipp LEFT JOIN patientmedecin p3 on patient.ipp = p3.ipp WHERE patient.nom = ?");
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        } elseif ($nomCateg == "observations" || $nomCateg == "prescription" || $nomCateg == "diagramme" || $nomCateg == "biologie" || $nomCateg == "imagerie" || $nomCateg == "courriers" ){
            $stmt = $pdo->prepare($requestlambda);
            $stmt -> bindParam(1,$nomPatient);
            $stmt->execute();
            $_SESSION['infosPatient']=[];
        }
        foreach ($stmt as $item){
            $_SESSION['infosPatient']+=$item;
        }
        header("Location: ../../Vue/DPIPatient/DPIpatientMacrocible.php");

    }
?>
