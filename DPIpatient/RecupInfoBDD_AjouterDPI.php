
<?php
function verification($elt){
    if (empty($elt)) {
        $elt = null;
    }
    return $elt;
}
function Connection(){
    $PDO = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;', 'postgres',                                         '');
    return $PDO;

}
// Fonction permettant d'intéragir avec la BDD
function Contact($PDO){
    $idContact = $PDO->prepare("SELECT max(idptel) from personnecontacte");
    $idContact->execute();
    foreach ($idContact as $idcont) {
        return $idcont[0] + 1;
    }
}
// Fonction permettant d'intéragir avec la BDD
function Confiant($PDO){
    $idConfiance = $PDO->prepare("SELECT max(idpcon) from personneconfiance");
    $idConfiance->execute();
    foreach ($idConfiance as $idconf) {
        return $idconf[0] + 1;
    }
}
// Fonction permettant d'intéragir avec la BDD
function PatientIPP($PDO){
    $idPatientIpp = $PDO->prepare("SELECT max(ipp)from patient");
    $idPatientIpp->execute();
    foreach ($idPatientIpp as $idpatIpp) {
        return $idpatIpp[0] + 1;
    }
}

// Fonction permettant d'intéragir avec la BDD
function PatientIEP($PDO)
{
    $idPatientIep = $PDO->prepare("SELECT max(iep)from patient");
    $idPatientIep->execute();
    foreach ($idPatientIep as $idpatIep) {
        return $idpatIep[0] + 1;
    }
}

function AjouterDPI ()
{
    $PDO = Connection();
    $contacte1 = Contact($PDO);
    $Contacte = $PDO->prepare("insert into personnecontacte (idptel, nom, prenom, tel, lien) VALUES (?,?,?,?,?)");
    $Contacte->bindParam(1, $contacte1);
    $Contacte->bindParam(2, $_POST['nomCT']); // Permets de récupérer le nom du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(3, $_POST['prenomCT']); // Permets de récupérer le prénom du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(4, $_POST['telCT']); // Permets de récupérer le téléphone du contact de la personne saisi dans le formulaire
    $Contacte->bindParam(5, $_POST['lienCT']); // Permets de récupérer le lien de parenté du contact de la personne saisi dans le formulaire
    $Contacte->execute();


    $confiance1 = Confiant($PDO);
    $boo = "true";
    $Confiance = $PDO->prepare("insert into personneconfiance (idpcon, nom, prenom, tel, lien, formulaire) VALUES (?,?,?,?,?,?)");
    $Confiance->bindParam(1, $confiance1);
    $Confiance->bindParam(2, $_POST['nomC']); // Permets de récupérer le nom de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(3, $_POST['prenomC']); // Permets de récupérer le prénom de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(4, $_POST['telC']); // Permets de récupérer le téléphone de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(5, $_POST['lienC']); // Permets de récupérer le lien de parenté de la personne de confiance saisi dans le formulaire
    $Confiance->bindParam(6, $boo);
    $Confiance->execute();


    $patientipp = PatientIPP($PDO);
    $patientiep = PatientIEP($PDO);
// Permet d'ajouter des informations dans la base de données //
    $Patient1 = $PDO->prepare("insert into patient (ipp, iep, nom, prenom, ddn, taille_cm, poids_kg, adresse, cp, ville, telpersonnel, telprofessionnel, allergies, antecedents, obstericaux, domedicaux, dochirurgicaux, idpcon, idptel, mesuredeprotection, asistantsocial, mdv, synentre, traidomi, dophypsy, mobilite, alimentation, hygiene, toilette, habit, continence)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $Patient1->bindParam(1, $patientipp);
    $Patient1->bindParam(2, $patientiep);
    $Patient1->bindParam(3, $_POST['nom']); // Permets de récupérer le nom saisi dans le formulaire
    $Patient1->bindParam(4, $_POST['prenom']); // Permets de récupérer le prénom saisi dans le formulaire
    $Patient1->bindParam(5, $_POST['DDN']); // Permets de récupérer la date de naissance saisie dans le formulaire
    $Patient1->bindParam(6, $_POST['taille']); // Permets de récupérer la taille saisie dans le formulaire
    $Patient1->bindParam(7, $_POST['poids']); // Permets de récupérer le poids saisi dans le formulaire
    $Patient1->bindParam(8, $_POST['adresse']); // Permets de récupérer l'adresse saisie dans le formulaire
    $Patient1->bindParam(9, $_POST['CP']); // Permets de récupérer le code postal saisi dans le formulaire
    $Patient1->bindParam(10, $_POST['ville']); // Permets de récupérer la ville saisie dans le formulaire
    $Patient1->bindParam(11, $_POST['telperso']); // Permets de récupérer le telperso saisi dans le formulaire
    $telpro = verification($_POST['telpro']); // Permets de vérifier si le telpro est bien saisi
    $Patient1->bindParam(12, $telpro);
    $allergies = verification($_POST['allergies']); // Permets de vérifier si les allergies sont bien saisi
    $Patient1->bindParam(13, $allergies);
    $antecedents = verification($_POST['antecedents']); // Permets de vérifier si les antécédents sont bien saisi
    $Patient1->bindParam(14, $antecedents);
    $Obs = verification($_POST['Obs']); // Permets de vérifier si les Obs sont bien saisi
    $Patient1->bindParam(15, $Obs);
    $docMed = verification($_POST['docMed']); // Permets de vérifier si les docMed sont bien saisi
    $Patient1->bindParam(16, $docMed);
    $docChir = verification($_POST['docChir']); // Permets de vérifier si les docChir sont bien saisi
    $Patient1->bindParam(17, $docChir);
    $Patient1->bindParam(18, $confiance1);
    $Patient1->bindParam(19, $contacte1);
    $Patient1->bindParam(20, $_POST['MP']); // Permets de récuperer les MP saisi dans le formulaire
    $Patient1->bindParam(21, $_POST['AC']); // Permets de récupérer les AC saisi dans le formulaire
    $MDV = verification($_POST['MDV']);
    $Patient1->bindParam(22, $MDV);
    $Patient1->bindParam(23, $_POST['synEntree']); // Permets de récupérer la synEntree saisi dans le formulaire
    $tradomi = verification($_POST['tradomi']); // Permets de vérifier si tradomi est bien saisi
    $Patient1->bindParam(24, $tradomi);
    $doPhyPsy = verification($_POST['doPhyPsy']); // Permets de vérifier si doPhyPsy est bien saisi
    $Patient1->bindParam(25, $doPhyPsy);
    $Patient1->bindParam(26, $_POST['CD']); // Permets de récupérer CD saisi dans le formulaire
    $Patient1->bindParam(27, $_POST['CM']); // Permets de récupérer CM saisi dans le formulaire
    $Patient1->bindParam(28, $_POST['CL']); // Permets de récupérer CL saisi dans le formulaire
    $Patient1->bindParam(29, $_POST['CT']); // Permets de récupérer CT saisi dans le formulaire
    $Patient1->bindParam(30, $_POST['CH']); // Permets de récupérer CH saisi dans le formulaire
    $Patient1->bindParam(31, $_POST['conti']); // Permets de récupérer conti saisie dans le formulaire
    $Patient1->execute();

// Permet d'afficher null dans la base de données si des informations ne sont pas renseignés //
    $_SESSION['nomp'] = null;
    $_SESSION['prenomp'] = null;
    $_SESSION['DDNp'] = null;
    $_SESSION['taillep'] = null;
    $_SESSION['poidsp'] = null;
    $_SESSION['adressep'] = null;
    $_SESSION['CPp'] = null;
    $_SESSION['villep'] = null;
    $_SESSION['telpersop'] = null;
    $_SESSION['telprop'] = null;
    $_SESSION['allergiesp'] = null;
    $_SESSION['antecedentsp'] = null;
    $_SESSION['Obsp'] = null;
    $_SESSION['docMedp'] = null;
    $_SESSION['docChirp'] = null;
    $_SESSION['MPp'] = null;
    $_SESSION['ACp'] = null;
    $_SESSION['MDVp'] = null;
    $_SESSION['synEntreep'] = null;
    $_SESSION['tradomip'] = null;
    $_SESSION['doPhyPsyp'] = null;
    $_SESSION['CDp'] = null;
    $_SESSION['CMp'] = null;
    $_SESSION['CLp'] = null;
    $_SESSION['CTp'] = null;
    $_SESSION['CHp'] = null;
    $_SESSION['contip'] = null;


    $_SESSION['nomCTp'] = null;
    $_SESSION['prenomCTp'] = null;
    $_SESSION['telCTp'] = null;
    $_SESSION['lienCTp'] = null;

    $_SESSION['nomCp'] = null;
    $_SESSION['prenomCp'] = null;
    $_SESSION['telCp'] = null;
    $_SESSION['lienCp'] = null;

}

function StockDPI ()
{
    $DPI1 = Connection();
    $DPI = $DPI1->prepare("Select * from Patient where ipp = ?");
    $DPI->bindParam(1, $_POST['recherche']);
    $DPI->execute();
    foreach ($DPI as $info) {
        return $info;
    }
}

function lstderoulante(){
    $DPI2 = Connection();
    $DPI = $DPI2->prepare("Select ipp, nom, prenom from Patient");
    $DPI->execute();
    return $DPI;
}

function nameColonne (){
    $DPI3 = Connection();
    $colonne = $DPI3->prepare("SELECT column_name, data_type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = ? order by ordinal_position");
    $table = 'patient';
    $colonne->bindParam(1,$table);
    $colonne->execute();
    $donnees = [];
    $typedonnees = [];
    foreach ($colonne as $don){
        $donnees[] = $don[0];
        $typedonnees[] = $don[1];;
    }
    $res = [$donnees,$typedonnees];
    return $res;
}

function modifer($ipp){
    $mod = Connection();
    $modif = $mod->prepare("UPDATE patient set nom = ?, prenom = ?, ddn = ?, taille_cm = ?, poids_kg = ?, adresse = ?,
                   cp = ?, ville = ?, telpersonnel = ?, telprofessionnel = ?, allergies = ?, antecedents = ?, obstericaux = ?, 
                   domedicaux = ?,dochirurgicaux = ?, mesuredeprotection = ?, asistantsocial = ?, mdv = ?, synentre = ?, 
                   dophypsy = ?, mobilite = ?, alimentation = ?, hygiene = ?, toilette = ?, habit = ?, continence= ? where ipp = ?");
    $modif->bindParam(1,$_POST['val2']);
    $modif->bindParam(2,$_POST['val3']);
    $modif->bindParam(3,$_POST['val4']);
    $modif->bindParam(4,$_POST['val5']);
    $modif->bindParam(5,$_POST['val6']);
    $modif->bindParam(6,$_POST['val7']);
    $modif->bindParam(7,$_POST['val8']);
    $modif->bindParam(8,$_POST['val9']);
    $modif->bindParam(9,$_POST['val10']);
    $modif->bindParam(10,$_POST['val11']);
    $modif->bindParam(11,$_POST['val12']);
    $modif->bindParam(12,$_POST['val13']);
    $modif->bindParam(13,$_POST['val14']);
    $modif->bindParam(14,$_POST['val15']);
    $modif->bindParam(15,$_POST['val16']);
    $modif->bindParam(16,$_POST['val19']);
    $modif->bindParam(17,$_POST['val20']);
    $modif->bindParam(18,$_POST['val21']);
    $modif->bindParam(19,$_POST['val22']);
    $modif->bindParam(20,$_POST['val23']);
    $modif->bindParam(21,$_POST['val24']);
    $modif->bindParam(22,$_POST['val25']);
    $modif->bindParam(23,$_POST['val26']);
    $modif->bindParam(24,$_POST['val27']);
    $modif->bindParam(25,$_POST['val28']);
    $modif->bindParam(26,$_POST['val29']);
    $modif->bindParam(27,$ipp);
    $modif->execute();



}
?>

