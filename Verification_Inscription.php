<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('Mail_Test.php');

function VerifEmptyContent($text)
{
    if ($text == "")
    { return 0; }
    else
    { return 1; }
}

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

function VerifEmail($email)
{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    { return 1; }
    else
    { return 0; }
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

$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["Password_A"]);
$resVerifPassword_Number=VerifPassword_Number($_POST["Password_A"]);
$resVerifPassword_Equality=VerifPassword_Equality($_POST["Password_A"], $_POST["Password_B"]);
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["Password_A"]);
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["Password_A"]);
$VerifEmptyContent1=VerifEmptyContent($_POST["email"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["ID"]);
$VerifEmptyContent3=VerifEmptyContent($_POST["Role"]);
$VerifEmail=VerifEmail($_POST["email"]);

$db_username = 'postgres';
$db_password = 'Post';
$db_name = 'test';
$db_host = 'localhost';

try {
    $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
    $stmt = $dbh->prepare("select count(*) from utilisateur where email= ?");
    $stmt->bindParam(1, $_POST['email']);
    $stmt->execute();
    $stmt3 = $dbh->prepare("SELECT count(*) FROM utilisateur where login = ? ");
    $stmt3->bindParam(1, $_POST['ID']);
    $stmt3->execute();
    $result = $stmt->fetchColumn(0);
    $result2 = $stmt3->fetchColumn(0);

    if($result==1){
        header('Location: Inscription_formulaire.php?erreur=7');
    }

    elseif($result2==1){
        header('Location: Inscription_formulaire.php?erreur=7');
    }

    elseif ($VerifEmptyContent3==1 and $VerifEmptyContent1==1 and $VerifEmptyContent2==1 and$resVerifPassword_Lowercase==1 and $resVerifPassword_Equality==1 and $resVerifPassword_Lenght==1 and $resVerifPassword_Uppercase==1 and $resVerifPassword_Number==1) {

        $options = [
            'cost' => 12,
        ];
        $mdpHacher=password_hash($_POST["Password_A"],PASSWORD_BCRYPT, $options);


        try {
            $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
            $stmt2 = $dbh->prepare("INSERT INTO utilisateur values (?,?,?,?)");
            $stmt2->bindParam(1, $_POST["ID"]);
            $stmt2->bindParam(2, $mdpHacher);
            $stmt2->bindParam(3, $_POST['email']);
            $stmt2->bindParam(4, $_POST['Role']);

            $stmt2->execute();
            header('Location: login.php');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

if ($resVerifPassword_Equality==0){
    header('Location: Inscription_formulaire.php?erreur=2');
}

elseif ($resVerifPassword_Lenght==0){
    header('Location: Inscription_formulaire.php?erreur=1');
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: Inscription_formulaire.php?erreur=3');
}

elseif($resVerifPassword_Number==0){
    header('Location: Inscription_formulaire.php?erreur=4');
}

elseif($resVerifPassword_Uppercase==0) {
    header('Location: Inscription_formulaire.php?erreur=5');
}

elseif ($VerifEmptyContent1==0){
    header('Location: Inscription_formulaire.php?erreur=6');
}

elseif ($VerifEmptyContent2==0){
    header('Location: Inscription_formulaire.php?erreur=6');
}

elseif ($VerifEmptyContent3==0){
    header('Location: Inscription_formulaire.php?erreur=6');
}

elseif ($VerifEmail==0){
    header('Location: Inscription_formulaire.php?erreur=7');
}

else
{
    SendMail($_POST["email"]);
}

?>
