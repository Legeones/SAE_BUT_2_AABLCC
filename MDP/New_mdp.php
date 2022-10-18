<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
ini_set('SMTP','smtp.gmail.com');
ini_set('smtp_port',587);

function VerifPassword_Equality($pw1,$pw2)
{
    if ( ($pw1 != $pw2) != 0 )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Lenght($pw1)
{
    if ( strlen($pw1) < 8 )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Uppercase($pw1)
{
    $pw1seg = str_split($pw1);
    $uppercasecheck = false;

    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[A-Z]/', $pw1seg[$i]) == 1)  { $uppercasecheck = true;   /*echo "UpperCase Found <br>";*/ } }

    if ( $uppercasecheck == false )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Lowercase($pw1)
{
    $pw1seg = str_split($pw1);
    $lowercasecheck = false;

    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[a-z]/', $pw1seg[$i]) == 1)  { $lowercasecheck = true;   /*echo "LowerCase Found <br>";*/ } }

    if ( $lowercasecheck == false )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Number($pw1)
{
    $pw1seg = str_split($pw1);
    $numbercheck = false;

    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[0-9]/', $pw1seg[$i]) == 1)  { $numbercheck = true;   /*echo "Number Found <br>";*/ } }

    if ( $numbercheck == false )
    { return 0; }
    else
    { return 1; }
}

$resVerifPassword_Equality=VerifPassword_Equality($_POST["New_Password_A"], $_POST["New_Password_B"]);
$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["New_Password_A"]);
$resVerifPassword_Number=VerifPassword_Number($_POST["New_Password_A"]);
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["New_Password_A"]);
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["New_Password_A"]);

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
        if($resVerifPassword_Lowercase==1 and $resVerifPassword_Equality==1 and $resVerifPassword_Lenght==1 and $resVerifPassword_Uppercase==1 and $resVerifPassword_Number==1) {

            $options = [
                'cost' => 12,
            ];
            $res2=password_hash($_POST["New_Password_A"],PASSWORD_BCRYPT, $options);


            try {
                $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
                $stmt = $dbh->prepare("UPDATE utilisateur SET mdp=? WHERE login=?");
                $stmt->bindParam(1, $res2);
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
        header('Location: change_mdp.php?erreur=6');
    }
}catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}


if ($resVerifPassword_Equality==0){
    header('Location: change_mdp.php?erreur=2');
}

elseif ($resVerifPassword_Lenght==0){
    header('Location: change_mdp.php?erreur=1');
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: change_mdp.php?erreur=3');
}

elseif($resVerifPassword_Number==0){
    header('Location: change_mdp.php?erreur=4');
}

elseif($resVerifPassword_Uppercase==0){
    header('Location: change_mdp.php?erreur=5');
}
?>
