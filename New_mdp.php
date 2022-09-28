<?php

function VerifPassword_Equality($password,$password2)
{
    if ($password != $password2)      { return 0; }
    else {return 1;}
}

$res=VerifPassword_Equality($_POST["New_Password_A"], $_POST["New_Password_B"]);



if($res==1) {
    $db_username = 'db_username';
    $db_password = 'db_pass';
    $db_name = 'db_name';
    $db_host = 'db_host';

    $options = [
        'cost' => 12,
    ];
    $res2=password_hash($_POST["New_Password_A"],PASSWORD_BCRYPT, $options);


    try {
        $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
        $stmt = $dbh->prepare("UPDATE utilisateur SET mot_de_passe=? WHERE email=?");
        $stmt->bindParam(1, $res2);
        $stmt->bindParam(2, $_POST["ID"]);

        $stmt->execute();
        header('Location: login.php');
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}
?>
