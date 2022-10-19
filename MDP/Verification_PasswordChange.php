<?php

require('../BDD/DataBase.php');

function VerifEmail($email)
{
    $email = filter_var($email,FILTER_SANITIZE_EMAIL);
    
    if(filter_var($email, FILTER_VALIDATE_EMAIL))
    { return 1; }
    else
    { return 0; }
}

function VerifEmptyContent($text)
{
    if ($text == "")
    { return 0; }
    else
    { return 1; }
}

$resVerifemptymail = VerifEmptyContent($_POST['mail']);
$resVerifemptyusername = VerifEmptyContent($_POST['username']);
$resVerifMail = VerifEmail($_POST['mail']);

if ( $resVerifMail == 0 )
{ header('Location: ../MDP/MDPoublier.php?erreur=1'); }

if ( $resVerifemptymail == 0 )
{ header('Location: ../MDP/MDPoublier.php?erreur=2'); }

if ( $resVerifemptyusername == 0 )
{ header('Location: ../MDP/MDPoublier.php?erreur=2'); }

else 
{
    DataBase_User_New_Pass_Check($_POST['username'],$_POST['mail']);
}


?>
