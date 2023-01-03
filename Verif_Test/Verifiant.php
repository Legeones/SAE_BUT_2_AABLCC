<?php

function VerifEmptyContent($text)
{
    if ($text == "")
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
    { if(preg_match('/[A-Z]/', $pw1seg[$i]) == 1)  { $uppercasecheck = true; } }
    
    if ( !$uppercasecheck )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Lowercase($pw1)
{
    $pw1seg = str_split($pw1);
    $lowercasecheck = false;
    
    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[a-z]/', $pw1seg[$i]) == 1)  { $lowercasecheck = true; } }
    
    if ( !$lowercasecheck )
    { return 0; }
    else
    { return 1; }
}

function VerifPassword_Number($pw1)
{
    $pw1seg = str_split($pw1);
    $numbercheck = false;
    
    for( $i = 0 ; $i < strlen($pw1) ; $i++ )
    { if(preg_match('/[\d]/', $pw1seg[$i]) == 1)  { $numbercheck = true; } }
    
    if ( !$numbercheck )
    { return 0; }
    else
    { return 1; }
}

?>
