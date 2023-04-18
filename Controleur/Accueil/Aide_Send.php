<?php
    
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);

require ('../Accueil/Mail.php');
require ('../Verifiant/Verifiant.php');


$VerifEmptyContent1=VerifEmptyContent($_POST['username']);
$VerifEmptyContent2=VerifEmptyContent($_POST['mail']);
$VerifEmptyContent3=VerifEmptyContent($_POST['body']);

$VerifEmail=VerifEmail($_POST["mail"]);
//Zone de vérification
if ($VerifEmptyContent1==0){
    header('Location: ../../Vue/Accueil/Aide.php?erreur=1'); // Zone de vérification
}

elseif ($VerifEmptyContent2==0){
    header('Location: ../../Vue/Accueil/Aide.php?erreur=1'); // Zone de vérification
}

elseif ($VerifEmptyContent3==0){
    header('Location: ../../Vue/Accueil/Aide.php?erreur=1'); // Zone de vérification
}

elseif ($VerifEmail==0){
    header('Location: ../../Vue/Accueil/Aide.php?erreur=2'); // Zone de vérification
}

else
{
    SendRequestMail($_POST['username'],$_POST['mail'],$_POST['body']);
    
    header('Location: ../../Vue/Connexion/login.php');
}
?>