<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
ini_set('SMTP','smtp.gmail.com');
ini_set('smtp_port',587);

$db_username = 'iutinfo86';
$db_password = 'pmD5t+DV';
$db_name = 'iutinfo86';
$db_host = 'iutinfo-sgbd.uphf.fr';

function VerifEmptyContent($text)
{
    if ($text == "")
    { return 0; }
    else
    { return 1; }
}

$VerifEmptyContent1=VerifEmptyContent($_POST["ID"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["Role"]);

if ($VerifEmptyContent1==0){
    header('Location: AttributionRole.php?erreur=2');
}

elseif ($VerifEmptyContent2==0){
    header('Location: AttributionRole.php?erreur=2');
}

try {
    $db_username = 'iutinfo86';
    $db_password = 'pmD5t+DV';
    $db_name = 'iutinfo86';
    $db_host = 'iutinfo-sgbd.uphf.fr';
    $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
    $stmt = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
    $stmt->bindParam(1, $_POST["ID"]);
    $stmt->execute();
    $result = $stmt->fetchColumn(0);

    if($result==1){
        if($VerifEmptyContent2==1 and $VerifEmptyContent1==1 and $result==1) {

            try {
                $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
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
    }
    else{
        header('Location: AttributionRole.php?erreur=1');
    }
}catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>