<h1>COUCOU</h1>
<?php
require 'Principal_PHP_Fonction_DPI_ADD_or_Modif.php';
session_start();
try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        creation_Session_Add_DPI($_SESSION['Debut'], $_SESSION['Fin']);
        creation_Session_Add_contacte($_SESSION['Debutct'], $_SESSION['Finct']);
        creation_Session_Add_confiance($_SESSION['Debutcf'], $_SESSION['Fincf']);
        $lesErreurs = erreur($_SESSION['Debut'], $_SESSION['Fin'], $_SESSION['Debutct'], $_SESSION['Finct'], $_SESSION['Debutcf'], $_SESSION['Fincf'])[0];
        $_SESSION['lstErreur'] = $lesErreurs;
        $lesErreurs_specifique = erreur($_SESSION['Debut'], $_SESSION['Fin'], $_SESSION['Debutct'], $_SESSION['Finct'], $_SESSION['Debutcf'], $_SESSION['Fincf'])[1];
        $_SESSION['lstErreur_specifique'] = $lesErreurs_specifique;
        print_r($lesErreurs);
        print_r($lesErreurs_specifique);

        if (empty($lesErreurs) and empty($lesErreurs_specifique)) {
            AjouterDPI();
            reset_session();
        }
        else{
            $_SESSION['MessErreur'] = "<p style='color:red'>!! Veuillez vérifier que le formulaire ne comporte pas d'erreur !!</p>";
            // Ici un message d'erreur apparait pour inviter à l'utilisateur de vérifier le formulaire
        }
        header('Location: AjouterDPI.php');
    }
}
catch (PDOException $e){
    print "Erreur:".$e->getMessage();
}
?>
