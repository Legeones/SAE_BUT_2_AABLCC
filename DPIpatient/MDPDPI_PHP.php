
<?php
session_start();
require 'Principal_PHP_Fonction_DPI_ADD_or_Modif.php';

if (empty($_POST['recherche'])){ // cette condition sert à utiliser le else ci-dessous avant pour ainsi modifer le DPI en fonction de son IPP
    if(isset($_SESSION['mdf'])&& $_SESSION['mdf'] != null){
        modifier($_SESSION['mdf']); // utilisation de la fonction modifier
        $_SESSION['mdf'] = null;
    }
}
else {
    $_SESSION['mdf'] = $_POST['recherche']; // l'ipp est stoke dans une session
    creation_Session($_SESSION['table'],$_SESSION['Debut'],$_SESSION['Fin']); // création des sessions
}
header('Location: MDFDPI.php');
?>
