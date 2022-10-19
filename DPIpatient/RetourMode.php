<?php
session_start();

if($_SESSION["Role"]=="pseudo-etu") {
    try {
        $db_username = 'iutinfo86';
        $db_password = 'pmD5t+DV';
        $db_name = 'iutinfo86';
        $db_host = 'iutinfo-sgbd.uphf.fr';
        $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
        $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
        $stmt->bindParam(1, $_SESSION["username"]);
        $stmt->execute();
        $result = $stmt->fetchColumn(0);

        if($result==1){

                try {
                    $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
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
?>
