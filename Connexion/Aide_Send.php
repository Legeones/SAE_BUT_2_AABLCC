<?php
    
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require('../Verif_Test/Mail.php');
require('../Verif_Test/Verifiant.php');

$VerifEmptyContent1=VerifEmptyContent($_POST['username']);
$VerifEmptyContent2=VerifEmptyContent($_POST['mail']);
$VerifEmptyContent3=VerifEmptyContent($_POST['body']);

$VerifEmail=VerifEmail($_POST["mail"]);

if ($VerifEmptyContent1==0){
    header('Location: ../Connexion/Aide.php?erreur=1');
}

elseif ($VerifEmptyContent2==0){
    header('Location: ../Connexion/Aide.php?erreur=1');
}

elseif ($VerifEmptyContent3==0){
    header('Location: ../Connexion/Aide.php?erreur=1');
}

elseif ($VerifEmail==0){
    header('Location: ../Connexion/Aide.php?erreur=2');
}

else
{
    SendRequestMail($_POST['username'],$_POST['mail'],$_POST['body']);
    
    header('Location: ../Connexion/login.php');
}
?>