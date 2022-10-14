<?php
session_start();

$db_username = '.';
$db_password = '.';
$db_name     = '.';
$db_host     = '.';


try {
    $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
    $stmt = $dbh->prepare("SELECT mot_de_passe FROM utilisateur where login = ? ");
    $stmt->bindParam(1, $_POST['username']);
    $stmt->execute();
    $stmt2 = $dbh->prepare("SELECT roles FROM utilisateur where login = ? ");
    $stmt2->bindParam(1, $_POST['username']);
    $stmt2->execute();
    $result = $stmt->fetchColumn(0);
    $result2 = $stmt2->fetchColumn(0);

    echo $result;
    if($res=password_verify($_POST['password'], $result)){
        $res2=5;
} else {
    $res2=0;
}
    if($res2==5){
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['Role'] = $result2;
        header('Location: principale.php');
    }
    else{
        header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
    }

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
