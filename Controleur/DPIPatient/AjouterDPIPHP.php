<?php

require ('../DPIPatient/Principal_PHP_Fonction_DPI_ADD_or_Modif.php');
session_start();
try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Toutes les sessions correspondent à la page AjouterDPI
        creation_Session_Add_DPI($_SESSION['Debut'], $_SESSION['Fin']);
        creation_Session_Add_contacte($_SESSION['Debutct'], $_SESSION['Finct']);
        creation_Session_Add_confiance($_SESSION['Debutcf'], $_SESSION['Fincf']);
        $lesErreurs = erreur($_SESSION['Debut'], $_SESSION['Fin'], $_SESSION['Debutct'], $_SESSION['Finct'], $_SESSION['Debutcf'], $_SESSION['Fincf'])[0];
        $_SESSION['lstErreur'] = $lesErreurs; //met toutes les erreurs rencontrées dans une liste
        $lesErreurs_specifique = erreur($_SESSION['Debut'], $_SESSION['Fin'], $_SESSION['Debutct'], $_SESSION['Finct'], $_SESSION['Debutcf'], $_SESSION['Fincf'])[1];
        $_SESSION['lstErreur_specifique'] = $lesErreurs_specifique;

        if (empty($lesErreurs) and empty($lesErreurs_specifique)) { // pour execute les 2 fonctions ci-dessous il faut que les 2 listes d'erreurs soient vides
            AjouterDPI(); //ajoute en DPI
            reset_session(); // met toutes les sessions à nulle
        }
        else{
            $_SESSION['MessErreur'] = "<p style='color:red'>!! Veuillez vérifier que le formulaire ne comporte pas d'erreur !!</p>";
            // Ici un message d'erreur apparaît pour inviter à l'utilisateur de vérifier le formulaire
        }
        header('Location: ../../Vue/DPIPatient/AjouterDPI.php'); // redirection vers la page AjouterDPI
    }
}
catch (PDOException $e){
    print "Erreur:".$e->getMessage();
}
?>
