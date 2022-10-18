<?php

    function DataBase_Creator_Unit()
    {
        $db_username = 'postgres';
        $db_password = 'Post';
        $db_name = 'test';
        $db_host = 'localhost';
        
        return new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
    }
    
    function Hasher($val,$hashed)
    {
        $options = [ 'cost' => $val, ];
        return password_hash($hashed,PASSWORD_BCRYPT, $options);
    }

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
                header('Location: Inscription_formulaire.php?erreur=7');
            }
            
            elseif($result2==1){
                header('Location: Inscription_formulaire.php?erreur=7');
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
            $stmt = $dbh->prepare("SELECT mot_de_passe FROM utilisateur where login = ? ");
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
            if($res2==5 and $result2=='prof'){
                $_SESSION['username'] = $username;
                header('Location: principale.php');
            }
            elseif ($res2==5 and $result2=='etu'){
                $_SESSION['username'] = $username;
                header('Location: principal-etu.php');
            }
            else{
                header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
            }
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
    
    function Database_User_Password_Modify($ID,$password)
    {
        $options = [
            'cost' => 12,
        ];
        $res2 = Hasher(12,$password);
        
        try {
            $dbh = Database_Creator_Unit();
            $stmt = $dbh->prepare("UPDATE utilisateur SET mot_de_passe=? WHERE login=?");
            $stmt->bindParam(1, $res2);
            $stmt->bindParam(2, $ID);
            
            $stmt->execute();
            header('Location: login.php');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
?>
