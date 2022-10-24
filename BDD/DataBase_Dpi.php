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

?>
