<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../BDD/DataBase.php');

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

if ($resVerifPassword_Equality==0){
    header('Location: ../MDP/change_mdp.php?erreur=2');
}

elseif ($resVerifPassword_Lenght==0){
    header('Location: ../MDP/change_mdp.php?erreur=1');
}

elseif($resVerifPassword_Lowercase==0){
    header('Location: ../MDP/change_mdp.php?erreur=3');
}

elseif($resVerifPassword_Number==0){
    header('Location: ../MDP/change_mdp.php?erreur=4');
}

elseif($resVerifPassword_Uppercase==0){
    header('Location: ../MDP/change_mdp.php?erreur=5');
}

else
{
    DataBase_User_New_Pass_Modify($_POST['ID'],$_POST['New_Password_A']);
}
?>
