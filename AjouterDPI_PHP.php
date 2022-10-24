
<h1>COUCOU</h1>
<?php

session_start();
try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $erreurs = [];

        if (empty($_POST['nom'])){
            $erreurs['nom'] = "<p style='color:red'>Le nom est obligatoire</p>";
            $_SESSION['nomf'] = $erreurs['nom'];
            $_SESSION['nomp'] = null;
        }
        else{$_SESSION['nomp'] = $_POST['nom'];}

        if (empty($_POST['prenom'])){
            $erreurs['prenom'] = "<p style='color:red'>Le prénom est obligatoire</p>";
            $_SESSION['prenomf'] = $erreurs['prenom'];
            $_SESSION['prenomp'] = null;
        }
        else{$_SESSION['prenomp'] = $_POST['prenom'];}

        if (empty($_POST['DDN'])){
            $erreurs['DDN'] = "<p style='color:red'>La date de naissance est obligatoire</p>";
            $_SESSION['DDNf'] = $erreurs['DDN'];
            $_SESSION['DDNp'] = null;
        }
        else{$_SESSION['DDNp'] = $_POST['DDN'];}

        if (empty($_POST['taille'])){
            $erreurs['taille'] = "<p style='color:red'>La taille est obligatoire</p>";
            $_SESSION['taillef'] = $erreurs['taille'];
            $_SESSION['taillep'] = null;
        }
        else{$_SESSION['taillep'] = $_POST['taille'];}

        if (empty($_POST['poids'])){
            $erreurs['poids'] = "<p style='color:red'>Le poids est obligatoire</p>";
            $_SESSION['poidsf'] = $erreurs['poids'];
            $_SESSION['poidsp'] = null;
        }
        elseif ($_POST['poids'] < 3 ){
            $erreurs['poids'] = "<p style='color:red'>Le poids est trop petit</p>";
            $_SESSION['poidsf'] = $erreurs['poids'];
            $_SESSION['poidsp'] = $_POST['poids'];
        }
        elseif ($_POST['poids'] > 600 ){
            $erreurs['poids'] = "<p style='color:red'>Le poids est trop grand</p>";
            $_SESSION['poidsf'] = $erreurs['poids'];
            $_SESSION['poidsp'] = $_POST['poids'];
        }
        else{$_SESSION['poidsp'] = $_POST['poids'];}

        /*
        if (empty($_POST['adresse'])) {
            $erreurs['adresse'] = "<p style='color:red'>L'adresse est obligatoire</p>";
            $_SESSION['adressef'] = $erreurs['adresse'];
        }
        if (empty($_POST['CP'])) {
            $erreurs['CP'] = "<p style='color:red'>Le code postale est obligatoire</p>";
            $_SESSION['CPf'] = $erreurs['CP'];
        }
        if (empty($_POST['ville'])) {
            $erreurs['ville'] = "<p style='color:red'>La ville est obligatoire</p>";
            $_SESSION['villef'] = $erreurs['ville'];
        }
        if (empty($_POST['telperso'])) {
            $erreurs['telperso'] = "<p style='color:red'>Le téléphone personnel est obligatoire</p>";
            $_SESSION['telpersof'] = $erreurs['telperso'];
        }

        /*********************************************************************************************************/
/*
        if (empty($_POST['nomCT'])) {
            $erreurs['nomCT'] = "<p style='color:red'>Le nom de la personne à contacter est obligatoire</p>";
            $_SESSION['nomCTf'] = $erreurs['nomCT'];
        }
        if (empty($_POST['prenomCT'])) {
            $erreurs['prenomCT'] = "<p style='color:red'>Le prenom de la personne à contacter est obligatoire</p>";
            $_SESSION['prenomCTf'] = $erreurs['prenomCT'];
        }
        if (empty($_POST['telCT'])) {
            $erreurs['telCT'] = "<p style='color:red'>Le téléphone de la personne à contacter est obligatoire</p>";
            $_SESSION['telCTf'] = $erreurs['telCT'];
        }
        if (empty($_POST['lienCT'])) {
            $erreurs['lienCT'] = "<p style='color:red'>Le lien familial de la personne à contacter est obligatoire</p>";
            $_SESSION['lienCTf'] = $erreurs['lienCT'];
        }

        /*********************************************************************************************************/
/*
        if (empty($_POST['nomC'])) {
            $erreurs['nomC'] = "<p style='color:red'>Le nom de la personne de confiance est obligatoire</p>";
            $_SESSION['nomCf'] = $erreurs['nomC'];
        }
        if (empty($_POST['prenomC'])) {
            $erreurs['prenomC'] = "<p style='color:red'>Le prenom du contact de confiance est obligatoire</p>";
            $_SESSION['prenomCf'] = $erreurs['prenomC'];
        }
        if (empty($_POST['telC'])) {
            $erreurs['telC'] = "<p style='color:red'>Le téléphone de la personne de confiance est obligatoire</p>";
            $_SESSION['telCf'] = $erreurs['telC'];
        }
        if (empty($_POST['lienC'])) {
            $erreurs['lienC'] = "<p style='color:red'>Le lien familial de la personne de confiance est obligatoire</p>";
            $_SESSION['lienCf'] = $erreurs['lienC'];
        }
*/
        if (empty($erreurs)) {
            $PDO = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;', 'postgres', 'Housezalex59330');

            $_SESSION['nomp'] = null;


            function Contact($PDO)
            {
                $idContact = $PDO->prepare("SELECT max(idptel) from personnecontacte");
                $idContact->execute();
                foreach ($idContact as $idcont) {
                    return $idcont[0] + 1;
                }

            }

            function Confiant($PDO)
            {
                $idConfiance = $PDO->prepare("SELECT max(idpcon) from personneconfiance");
                $idConfiance->execute();
                foreach ($idConfiance as $idconf) {
                    return $idconf[0] + 1;
                }

            }

            function PatientIPP($PDO)
            {
                $idPatientIpp = $PDO->prepare("SELECT max(ipp)from patient");
                $idPatientIpp->execute();
                foreach ($idPatientIpp as $idpatIpp) {
                    return $idpatIpp[0] + 1;
                }
            }

            function PatientIEP($PDO)
            {
                $idPatientIep = $PDO->prepare("SELECT max(iep)from patient");
                $idPatientIep->execute();
                foreach ($idPatientIep as $idpatIep) {
                    return $idpatIep[0] + 1;
                }
            }

            $contacte1 = Contact($PDO);
            $Contacte = $PDO->prepare("insert into personnecontacte (idptel, nom, prenom, tel, lien) VALUES (?,?,?,?,?)");
            $Contacte->bindParam(1, $contacte1);
            $Contacte->bindParam(2, $_POST['nomCT']);
            $Contacte->bindParam(3, $_POST['prenomCT']);
            $Contacte->bindParam(4, $_POST['telCT']);
            $Contacte->bindParam(5, $_POST['lienCT']);
            $Contacte->execute();


            $confiance1 = Confiant($PDO);
            $boo = "false";
            $Confiance = $PDO->prepare("insert into personneconfiance (idpcon, nom, prenom, tel, lien, formulaire) VALUES (?,?,?,?,?,?)");
            $Confiance->bindParam(1, $confiance1);
            $Confiance->bindParam(2, $_POST['nomC']);
            $Confiance->bindParam(3, $_POST['prenomC']);
            $Confiance->bindParam(4, $_POST['telC']);
            $Confiance->bindParam(5, $_POST['lienC']);
            $Confiance->bindParam(6, $boo);
            $Confiance->execute();


            $patientipp = PatientIPP($PDO);
            $patientiep = PatientIEP($PDO);
            $Patient1 = $PDO->prepare("insert into patient (ipp, iep, nom, prenom, ddn, taille_cm, poids_kg, adresse, cp, ville, telpersonnel, telprofessionnel, allergies, antecedents, obstericaux, domedicaux, dochirurgicaux, idpcon, idptel) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $Patient1->bindParam(1, $patientipp);
            $Patient1->bindParam(2, $patientiep);
            $Patient1->bindParam(3, $_POST['nom']);
            $Patient1->bindParam(4, $_POST['prenom']);
            $Patient1->bindParam(5, $_POST['DDN']);
            $Patient1->bindParam(6, $_POST['taille']);
            $Patient1->bindParam(7, $_POST['poids']);
            $Patient1->bindParam(8, $_POST['adresse']);
            $Patient1->bindParam(9, $_POST['CP']);
            $Patient1->bindParam(10, $_POST['ville']);
            $Patient1->bindParam(11, $_POST['telperso']);
            $Patient1->bindParam(12, $_POST['telpro']);
            $Patient1->bindParam(13, $_POST['allergies']);
            $Patient1->bindParam(14, $_POST['antecedents']);
            $Patient1->bindParam(15, $_POST['Obs']);
            $Patient1->bindParam(16, $_POST['docMed']);
            $Patient1->bindParam(17, $_POST['docChir']);
            $Patient1->bindParam(18, $confiance1);
            $Patient1->bindParam(19, $contacte1);
            $Patient1->execute();


        }
        header('Location: http://localhost:63342/AjouterDPI.php/AjouterDPI.php?_ijt=sc2ldh7qsve9t7rbtjn44kf3pb&_ij_reload=RELOAD_ON_SAVE');
    }
}
catch (PDOException $e){
    print "Erreur:".$e->getMessage();
}
?>
