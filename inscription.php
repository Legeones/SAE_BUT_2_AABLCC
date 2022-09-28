<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

function VerifPassword_Equality($password,$password2)
{
    if ($password != $password2)      { return 0; }
    else {return 1;}
}

function VerifPassword($password,$password2)
{
    try
    {
        VerifPassword_Equality($password,$password2);
    }
    catch (Exception $e) { echo 'Exception recue : ',  $e->getMessage(), "\n"; }
}

$res=VerifPassword_Equality($_POST["Password_A"], $_POST["Password_B"]);

if($res==1) {
    $db_username = 'db_username';
    $db_password = 'db_pass';
    $db_name = 'db_name';
    $db_host = 'db_host';

    $options = [
        'cost' => 12,
    ];
    $mdpHacher=password_hash($_POST["Password_A"],PASSWORD_BCRYPT, $options);


    try {
        $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
        $stmt = $dbh->prepare("INSERT INTO utilisateur values (?,?,?)");
        $stmt->bindParam(1, $_POST["ID"]);
        $stmt->bindParam(2, $mdpHacher);
        $stmt->bindParam(3, $_POST['Role']);

        $stmt->execute();
        header('Location: login.php');
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}



?>
