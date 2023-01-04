<h1>COUCOU</h1>
<?php

session_start();
try {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {


        $erreurs = [];
// Ici une erreur est affiché si le nom de la personne n'est pas renseigné //
        if (empty($_POST['nom'])) {
            $erreurs['nom'] = "<p style='color:red'>Le nom est obligatoire</p>";
            $_SESSION['nomf'] = $erreurs['nom'];
            $_SESSION['nomp'] = null;
        } else {
            $_SESSION['nomp'] = $_POST['nom'];
        }
// Ici une erreur est affiché si le prénom de la personne n'est pas renseigné //
        if (empty($_POST['prenom'])) {
            $erreurs['prenom'] = "<p style='color:red'>Le prénom est obligatoire</p>";
            $_SESSION['prenomf'] = $erreurs['prenom'];
            $_SESSION['prenomp'] = null;
        } else {
            $_SESSION['prenomp'] = $_POST['prenom'];
        }
// Ici une erreur est affiché si la date de naissance de la personne n'est pas renseigné //
        if (empty($_POST['DDN'])) {
            $erreurs['DDN'] = "<p style='color:red'>La date de naissance est obligatoire</p>";
            $_SESSION['DDNf'] = $erreurs['DDN'];
            $_SESSION['DDNp'] = null;
        } else {
            $_SESSION['DDNp'] = $_POST['DDN'];
        }
// Ici une erreur est affiché si la taille de la personne n'est pas renseigné //
        if (empty($_POST['taille'])) {
            $erreurs['taille'] = "<p style='color:red'>La taille est obligatoire</p>";
            $_SESSION['taillef'] = $erreurs['taille'];
            $_SESSION['taillep'] = null;
        } else {
            $_SESSION['taillep'] = $_POST['taille'];
        }
// Ici une erreur est affiché si le poids de la personne n'est pas renseigné //
        if (empty($_POST['poids'])) {
            $erreurs['poids'] = "<p style='color:red'>Le poids est obligatoire</p>";
            $_SESSION['poidsf'] = $erreurs['poids'];
            $_SESSION['poidsp'] = null;
// Ici une erreur est afficher si le poids de la personne est inférieur à 3KG //
        } elseif ($_POST['poids'] < 3) {
            $erreurs['poids'] = "<p style='color:red'>Le poids est trop petit</p>";
            $_SESSION['poidsf'] = $erreurs['poids'];
            $_SESSION['poidsp'] = $_POST['poids'];
// Ici une erreur est afficher si le poids de la personne est supérieur à 600KG //
        } elseif ($_POST['poids'] > 600) {
            $erreurs['poids'] = "<p style='color:red'>Le poids est trop grand</p>";
            $_SESSION['poidsf'] = $erreurs['poids'];
            $_SESSION['poidsp'] = $_POST['poids'];
        }
        else {
            $_SESSION['poidsp'] = $_POST['poids'];
        }
// Ici une erreur est affiché si l'adresse de la personne n'est pas renseigné //
        if (empty($_POST['adresse'])) {
            $erreurs['adresse'] = "<p style='color:red'>L'adresse est obligatoire</p>";
            $_SESSION['adressef'] = $erreurs['adresse'];
            $_SESSION['adressep'] = null;
        } else {
            $_SESSION['adressep'] = $_POST['adresse'];
        }
// Ici une erreur est affiché si le code postal de la personne n'est pas obligatoire //
        if (empty($_POST['CP'])) {
            $erreurs['CP'] = "<p style='color:red'>Le code postal est obligatoire</p>";
            $_SESSION['CPf'] = $erreurs['CP'];
            $_SESSION['CPp'] = null;
        } elseif ($_POST['CP']<= 10000 || $_POST['CP'] >= 99999) {
            $erreurs['CP'] = "<p style='color:red'>Le code postal invalide</p>";
            $_SESSION['CPf'] = $erreurs['CP'];
            $_SESSION['CPp'] = null;
        } else {
            $_SESSION['CPp'] = $_POST['CP'];
        }
// Ici une erreur est affiché si la ville de la personne n'est pas renseigné //
        if (empty($_POST['ville'])) {
            $erreurs['ville'] = "<p style='color:red'>La ville est obligatoire</p>";
            $_SESSION['villef'] = $erreurs['ville'];
            $_SESSION['villep'] = null;
        } else {
            $_SESSION['villep'] = $_POST['ville'];
        }
// Ici une erreur est affiché si le téléphone personnel de la personne n'est pas renseigné //
        if (empty($_POST['telperso'])) {
            $erreurs['telperso'] = "<p style='color:red'>Le téléphone personnel est obligatoire</p>";
            $_SESSION['telpersof'] = $erreurs['telperso'];
            $_SESSION['telpersop'] = null;
        } else {
            $_SESSION['telpersop'] = $_POST['telperso'];
        }

        if (!empty($_POST['telpro'])) {
            $_SESSION['telprop'] = $_POST['telpro'];
        }

        if (!empty($_POST['allergies'])) {
            $_SESSION['allergiesp'] = $_POST['allergies'];
        }

        if (!empty($_POST['antecedents'])) {
            $_SESSION['antecedentsp'] = $_POST['antecedents'];
        }

        if (!empty($_POST['Obs'])) {
            $_SESSION['Obsp'] = $_POST['Obs'];
        }

        if (!empty($_POST['docMed'])) {
            $_SESSION['docMedp'] = $_POST['docMed'];
        }

        if (!empty($_POST['docChir'])) {
            $_SESSION['docChirp'] = $_POST['docChir'];
        }
// Ici une erreur est affiché si la mesure de protection n'est pas renseigné //
        if (empty($_POST['MP'])) {
            $erreurs['MP'] = "<p style='color:red'>La mesure de protection est obligatoire</p>";
            $_SESSION['MPf'] = $erreurs['MP'];
            $_SESSION['MPp'] = null;
        } else {
            $_SESSION['MPp'] = $_POST['MP'];
        }
// Ici une erreur est affiché si l'assistante sociale n'est pas renseigné //
        if (empty($_POST['AC'])) {
            $erreurs['AC'] = "<p style='color:red'>L'assistante sociale est obligatoire</p>";
            $_SESSION['ACf'] = $erreurs['AC'];
            $_SESSION['ACp'] = null;
        } else {
            $_SESSION['ACp'] = $_POST['AC'];
        }

        if (!empty($_POST['MDV'])) {
            $_SESSION['MDVp'] = $_POST['MDV'];
        }
// Ici une erreur est affiché si la synthèse d'entrée n'est pas renseigné //
        if (empty($_POST['synEntree'])) {
            $erreurs['synEntree'] = "<p style='color:red'>La synthèse d'entrée est obligatoire</p>";
            $_SESSION['synEntreef'] = $erreurs['synEntree'];
            $_SESSION['synEntreep'] = null;
        } else {
            $_SESSION['synEntreep'] = $_POST['synEntree'];
        }

        if (!empty($_POST['tradomi'])) {
            $_SESSION['tradomip'] = $_POST['tradomi'];
        }

        if (!empty($_POST['doPhyPsy'])) {
            $_SESSION['doPhyPsyp'] = $_POST['doPhyPsy'];
        }
// Ici une erreur est affiché si la capacité à se déplacer n'est pas renseigné //
        if (empty($_POST['CD'])) {
            $erreurs['CD'] = "<p style='color:red'>La capacité à se déplacer est obligatoire</p>";
            $_SESSION['CDf'] = $erreurs['CD'];
            $_SESSION['CDp'] = null;
        } else {
            $_SESSION['CDp'] = $_POST['CD'];
        }
// Ici une erreur est affiché si la capacité à manger n'est pas renseigné //
        if (empty($_POST['CM'])) {
            $erreurs['CM'] = "<p style='color:red'>La capacité à manger est obligatoire</p>";
            $_SESSION['CMf'] = $erreurs['CM'];
            $_SESSION['CMp'] = null;
        } else {
            $_SESSION['CMp'] = $_POST['CM'];
        }
// Ici une erreur est affiché si la capacité à se laver n'est pas renseigné //
        if (empty($_POST['CL'])) {
            $erreurs['CL'] = "<p style='color:red'>La capacité à se laver est obligatoire</p>";
            $_SESSION['CLf'] = $erreurs['CL'];
            $_SESSION['CLp'] = null;
        } else {
            $_SESSION['CLp'] = $_POST['CL'];
        }
// Ici une erreur est affiché si la capacité à aller au toilette n'est pas renseigné //
        if (empty($_POST['CT'])) {
            $erreurs['CT'] = "<p style='color:red'>La capacité à aller au toilette est obligatoire</p>";
            $_SESSION['CTf'] = $erreurs['CT'];
            $_SESSION['CTp'] = null;
        } else {
            $_SESSION['CTp'] = $_POST['CT'];
        }
// Ici une erreur est affiché si la capacité à s'habiller n'est pas renseigné //
        if (empty($_POST['CH'])) {
            $erreurs['CH'] = "<p style='color:red'>La capacité à s'habiller est obligatoire</p>";
            $_SESSION['CHf'] = $erreurs['CH'];
            $_SESSION['CHp'] = null;
        } else {
            $_SESSION['CHp'] = $_POST['CH'];
        }
// Ici une erreur est affiché si la capacité de continance n'est pas renseigné //
        if (empty($_POST['conti'])) {
            $erreurs['conti'] = "<p style='color:red'>La capacité de continance est obligatoire</p>";
            $_SESSION['contif'] = $erreurs['conti'];
            $_SESSION['contip'] = null;
        } else {
            $_SESSION['contip'] = $_POST['conti'];
        }
        /*********************************************************************************************************/
// Ici une erreur est affiché si le nom de la personne à contacter n'est pas renseigné //
        if (empty($_POST['nomCT'])) {
            $erreurs['nomCT'] = "<p style='color:red'>Le nom de la personne à contacter est obligatoire</p>";
            $_SESSION['nomCTf'] = $erreurs['nomCT'];
            $_SESSION['nomCTp'] = null;
        } else {
            $_SESSION['nomCTp'] = $_POST['nomCT'];
        }
// Ici une erreur est affiché si le prénom de la personne à contacter n'est pas renseigné //
        if (empty($_POST['prenomCT'])) {
            $erreurs['prenomCT'] = "<p style='color:red'>Le prénom de la personne à contacter est obligatoire</p>";
            $_SESSION['prenomCTf'] = $erreurs['prenomCT'];
            $_SESSION['prenomCTp'] = null;
        } else {
            $_SESSION['prenomCTp'] = $_POST['prenomCT'];
        }
// Ici une erreur est affiché si le téléphone de la personne à contacter n'est pas renseigné //
        if (empty($_POST['telCT'])) {
            $erreurs['telCT'] = "<p style='color:red'>Le téléphone de la personne à contacter est obligatoire</p>";
            $_SESSION['telCTf'] = $erreurs['telCT'];
            $_SESSION['telCTp'] = null;
        } else {
            $_SESSION['telCTp'] = $_POST['telCT'];
        }
// Ici une erreur est affiché si le lien familial de la personne à contacter n'est pas renseigné //
        if (empty($_POST['lienCT'])) {
            $erreurs['lienCT'] = "<p style='color:red'>Le lien familial de la personne à contacter est obligatoire</p>";
            $_SESSION['lienCTf'] = $erreurs['lienCT'];
            $_SESSION['lienCTp'] = null;
        } else {
            $_SESSION['lienCTp'] = $_POST['lienCT'];
        }

        /*********************************************************************************************************/
// Ici une erreur est affiché si le nom de la personne de confiance n'est pas renseigné //
        if (empty($_POST['nomC'])) {
            $erreurs['nomC'] = "<p style='color:red'>Le nom de la personne de confiance est obligatoire</p>";
            $_SESSION['nomCf'] = $erreurs['nomC'];
            $_SESSION['nomCp'] = null;
        } else {
            $_SESSION['nomCp'] = $_POST['nomC'];
        }
// Ici une erreur est affiché si le prénom du contact de confiance n'est pas renseigné //
        if (empty($_POST['prenomC'])) {
            $erreurs['prenomC'] = "<p style='color:red'>Le prénom du contact de confiance est obligatoire</p>";
            $_SESSION['prenomCf'] = $erreurs['prenomC'];
            $_SESSION['prenomCp'] = null;
        } else {
            $_SESSION['prenomCp'] = $_POST['prenomC'];
        }
// Ici une erreur est affiché si le téléphone de la personne de confiance n'est pas renseigné //
        if (empty($_POST['telC'])) {
            $erreurs['telC'] = "<p style='color:red'>Le téléphone de la personne de confiance est obligatoire</p>";
            $_SESSION['telCf'] = $erreurs['telC'];
            $_SESSION['telCp'] = null;
        } else {
            $_SESSION['telCp'] = $_POST['telC'];
        }
// Ici une erreur est affiché si le lien familial de la personne de confiance n'est pas renseigné //
        if (empty($_POST['lienC'])) {
            $erreurs['lienC'] = "<p style='color:red'>Le lien familial de la personne de confiance est obligatoire</p>";
            $_SESSION['lienCf'] = $erreurs['lienC'];
            $_SESSION['lienCp'] = null;
        } else {
            $_SESSION['lienCp'] = $_POST['lienC'];
        }

        /*********************************************************************************************************/
// Ici une erreur est affiché si le formulaire comporte des erreurs //
        if (!empty($erreurs)) {
            $_SESSION['MessErreur'] = "<p style='color:red'> !! Veuillez vérifier que le formulaire ne comporte pas d'erreur !!</p>";
        } else {
            $_SESSION['MessErreur'] = null;
        }

        /*********************************************************************************************************/

        if (empty($erreurs)) {
            require "RecupInfoBDD_AjouterDPI.php";
            AjouterDPI();
        }
        header('Location: AjouterDPI.php');
    }
}
catch (PDOException $e){
    print "Erreur:".$e->getMessage();
}
?>