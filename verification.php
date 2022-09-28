<?php
session_start();

$db_username = 'db_username';
    $db_password = 'db_pass';
    $db_name = 'db_name';
    $db_host = 'db_host';

try {
    $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
    $stmt = $dbh->prepare("SELECT mot_de_passe FROM utilisateur where email = ? ");
    $stmt->bindParam(1, $_POST['username']);
    $stmt->execute();
    $stmt2 = $dbh->prepare("SELECT roles FROM utilisateur where email = ? ");
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
    if($res2==5 and $result2=='prof'){
        $_SESSION['username'] = $_POST['username'];
        header('Location: principale.php');
    }
    elseif ($res2==5 and $result2=='etu'){
        $_SESSION['username'] = $_POST['username'];
        header('Location: principal-etu.php');
    }
    else{
        header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
    }

} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
?>
