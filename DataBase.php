<?php

    function Database_Add_User()
    {
        $db_username = 'postgres';
        $db_password = 'Post';
        $db_name = 'test';
        $db_host = 'localhost';
        
        try {
            $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
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
                    $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
                    $stmt2 = $dbh->prepare("INSERT INTO utilisateur values (?,?,?,?)");
                    $stmt2->bindParam(1, $_SESSION["IDENTIFIANT"]);
                    $stmt2->bindParam(2, $_SESSION['PASSWORD']);
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

?>
