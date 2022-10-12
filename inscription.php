<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
ini_set('SMTP','smtp.gmail.com');
ini_set('smtp_port',587);

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

function VerifEmail($pw1)
{
    $pw1seg = str_split($pw1);
    $lowercasecheck = false;

    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[@]/', $pw1seg[$i]) == 1)  { $lowercasecheck = true;   /*echo "LowerCase Found <br>";*/ } }

    if ( $lowercasecheck == false )
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
$resVerifPassword_Uppercase=VerifPassword_Uppercase($_POST["Password_A"]);
$resVerifPassword_Number=VerifPassword_Number($_POST["Password_A"]);
$resVerifPassword_Equality=VerifPassword_Equality($_POST["Password_A"], $_POST["Password_B"]);
$resVerifPassword_Lenght=VerifPassword_Lenght($_POST["Password_A"]);
$resVerifPassword_Lowercase=VerifPassword_Lowercase($_POST["Password_A"]);
$VerifEmptyContent1=VerifEmptyContent($_POST["email"]);
$VerifEmptyContent2=VerifEmptyContent($_POST["ID"]);
$VerifEmail=VerifEmail($_POST["email"]);

$db_username = '.';
$db_password = '.';
$db_name = '.';
$db_host = '.';

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

    elseif ($VerifEmptyContent1==1 and $VerifEmptyContent2==1 and$resVerifPassword_Lowercase==1 and $resVerifPassword_Equality==1 and $resVerifPassword_Lenght==1 and $resVerifPassword_Uppercase==1 and $resVerifPassword_Number==1) {

        $options = [
            'cost' => 12,
        ];
        $mdpHacher=password_hash($_POST["Password_A"],PASSWORD_BCRYPT, $options);


        try {
            $dbh = new PDO("pgsql:host=$db_host;port=5432;dbname=$db_name;user=$db_username;password=$db_password");
            $stmt2 = $dbh->prepare("INSERT INTO utilisateur values (?,?,?,?)");
            $role='etu';
            $stmt2->bindParam(1, $_POST["ID"]);
            $stmt2->bindParam(2, $mdpHacher);
            $stmt2->bindParam(3, $_POST['email']);
            $stmt2->bindParam(4, $role);

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

elseif ($VerifEmail ==0){
    header('Location: Inscription_formulaire.php?erreur=7');
}

?>
