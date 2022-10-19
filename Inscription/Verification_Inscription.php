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

$options = [
    'cost' => 12,
];
$mdpHacher=password_hash($_POST["Password_A"],PASSWORD_BCRYPT, $options);
session_start();
$_SESSION['EMAIL'] = $_POST['email'];
$_SESSION['IDENTIFIANT'] = $_POST['ID'];
$_SESSION['ROLE'] = $_POST['Role'];
$_SESSION['PASSWORD'] = $mdpHacher;

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
    session_start();
    $_SESSION['Code'] = rand(100000,999999);
    
    SendMail($_SESSION['Code'],$_POST['email']);
    
    header('Location: MailCode_Formulaire.php?');
}

?>

