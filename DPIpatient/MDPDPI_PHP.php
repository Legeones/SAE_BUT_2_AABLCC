
<?php
session_start();
require 'Principal_PHP_Fonction_DPI_ADD_or_Modif.php';

if (empty($_POST['recherche'])){
    if(isset($_SESSION['mdf'])&& $_SESSION['mdf'] != null){
        modifier($_SESSION['mdf']);
        $_SESSION['mdf'] = null;
    }
}
else {
    $_SESSION['mdf'] = $_POST['recherche'];
    creation_Session($_SESSION['table'],$_SESSION['Debut'],$_SESSION['Fin']);
}
header('Location: MDFDPI.php');
?>
