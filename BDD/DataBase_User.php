<?php

require('../BDD/DataBase_Core.php');

session_start();

function Database_Add_User()
{
    $password_hashed = Hasher(12,$_SESSION['PASSWORD']);
    
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("select count(*) from utilisateur where email= ?");
        $stmt->bindParam(1, $_SESSION['EMAIL']);
        $stmt->execute();
        $stmt3 = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
        $stmt3->bindParam(1, $_SESSION['IDENTIFIANT']);
        $stmt3->execute();
        $result = $stmt->fetchColumn(0);
        $result2 = $stmt3->fetchColumn(0);
        
        if($result==1){
            header('Location: ../Inscription/Inscription_formulaire.php?erreur=7');
        }
        
        elseif($result2==1){
            header('Location: ../Inscription/Inscription_formulaire.php?erreur=7');
        }
        
        try {
            $dbh = DataBase_Creator_Unit();
            $stmt2 = $dbh->prepare("INSERT INTO utilisateur values (?,?,?,?)");
            $stmt2->bindParam(1, $_SESSION["IDENTIFIANT"]);
            $stmt2->bindParam(2, $password_hashed);
            $stmt2->bindParam(3, $_SESSION['EMAIL']);
            $stmt2->bindParam(4, $_SESSION['ROLE']);
            
            $stmt2->execute();
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function Database_Check_User_Exist($username,$password)
{
    session_start();
    
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
        if($res2==5 and ($result2=='prof' or $result2=='admin')){
            $_SESSION['username'] = $username;
            $_SESSION['Role'] = $result2;
            header('Location: ../DPIpatient/DPI.php');
        }
        elseif ($res2==5 and $result2=='etudiant'){
            $_SESSION['username'] = $username;
            $_SESSION['Role'] = $result2;
            header('Location: ../DPIpatient/DPI.php');
        }
        else{
            header('Location: ../Connexion/login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function Database_User_New_Pass_Check()
{
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
        $stmt->bindParam(1, $_SESSION['IDENTIFIANT']);
        $stmt->execute();
        $result = $stmt->fetchColumn(0);
        
        if($result==1)
        {
            header('Location: ../MDP/change_mdp.php');
        }
        else{
            header('Location: ../MDP/MDPoublier.php?erreur=1');
        }
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function Database_User_New_Pass_Modify($ID,$password)
{
    $res2 = Hasher(12,$password);
    
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt = $dbh->prepare("UPDATE utilisateur SET mdp=? WHERE login=?");
        $stmt->bindParam(1, $res2);
        $stmt->bindParam(2, $ID);
        
        $stmt->execute();
        header('Location: ../Connexion/login.php');
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}

function DataBase_Attribute_Role($ID,$Role)
{
    session_start();
    
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

function DataBase_Pseudo_Etu_Return()
{
    session_start();
    
    if($_SESSION["Role"]=="pseudo-etu") {
        try {
            $dbh = DataBase_Creator_Unit();
            $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
            $stmt->bindParam(1, $_SESSION["username"]);
            $stmt->execute();
            $result = $stmt->fetchColumn(0);
            
            if($result==1){
                
                try {
                    $dbh = DataBase_Creator_Unit();
                    $stmt = $dbh->prepare("SELECT roles FROM utilisateur where login = ? ");
                    $stmt->bindParam(1, $_SESSION["username"]);
                    $stmt->execute();
                    $result = $stmt->fetchColumn(0);
                    $_SESSION["Role"] = $result;
                    header("Location: DPI.php");
                } catch (PDOException $e) {
                    print "Erreur !: " . $e->getMessage() . "<br/>";
                    die();
                }
                
            }
            else{
                header('Location: AttributionRole.php?erreur=1');
            }
        }catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
?>
?>
