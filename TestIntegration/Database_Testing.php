<?php

require ('../Model/BDD/DataBase_Core.php');

session_start();

function Database_Check_User_Exist_ForTest($username,$password)
{
    
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("SELECT mdp FROM utilisateur where login = ? ");
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $stmt2 = $dbh->prepare("SELECT roles FROM utilisateur where login = ? ");
        $stmt2->bindParam(1, $username);
        $stmt2->execute();
        $result = $stmt->fetchColumn(0);
        $result2 = $stmt2->fetchColumn(0);
        
        echo $result;
        if($res=password_verify($password, $result)){
            $res2=5;
        } else {
            $res2=0;
        }
        if($res2==5 && ($result2=='prof' || $result2=='admin' || $result2=='etudiant')){
            $_SESSION['username'] = $username;
            $_SESSION['Role'] = $result2;
            return true;
        }
        else{
            return false;
        }
        
    } catch (PDOException $e) {
        Errorprint($e);
        die();
    }
}

?>