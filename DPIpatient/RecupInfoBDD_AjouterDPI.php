
<?php
function verification($elt){
    if (empty($elt)) {
        $elt = 'rien';
    }
    return $elt;
}
function Connection(){
    $PDO = new PDO('pgsql:host=localhost;port=5432;dbname=postgres;', 'postgres',                                         'steven59330');
    return $PDO;

}

function Contact($PDO){
    $idContact = $PDO->prepare("SELECT max(idptel) from personnecontacte");
    $idContact->execute();
    foreach ($idContact as $idcont) {
        return $idcont[0] + 1;
    }
}

function Confiant($PDO){
    $idConfiance = $PDO->prepare("SELECT max(idpcon) from personneconfiance");
    $idConfiance->execute();
    foreach ($idConfiance as $idconf) {
        return $idconf[0] + 1;
    }
}

function PatientIPP($PDO){
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

function AjouterDPI ()
{
    $PDO = Connection();
    $contacte1 = Contact($PDO);
    $Contacte = $PDO->prepare("insert into personnecontacte (idptel, nom, prenom, tel, lien) VALUES (?,?,?,?,?)");
    $Contacte->bindParam(1, $contacte1);
    $Contacte->bindParam(2, $_POST['nomCT']);
    $Contacte->bindParam(3, $_POST['prenomCT']);
    $Contacte->bindParam(4, $_POST['telCT']);
    $Contacte->bindParam(5, $_POST['lienCT']);
    $Contacte->execute();


    $confiance1 = Confiant($PDO);
    $boo = "true";
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
// Permet d'ajouter des informations dans la base de données //
    $Patient1 = $PDO->prepare("insert into patient (ipp, iep, nom, prenom, ddn, taille_cm, poids_kg, adresse, cp, ville, telpersonnel, telprofessionnel, allergies, antecedents, obstericaux, domedicaux, dochirurgicaux, idpcon, idptel, mesuredeprotection, asistantsocial, mdv, synentre, traidomi, dophypsy, mobilite, alimentation, hygiene, toilette, habit, continence)
VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
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
    $telpro = verification($_POST['telpro']);
    $Patient1->bindParam(12, $telpro);
    $allergies = verification($_POST['allergies']);
    $Patient1->bindParam(13, $allergies);
    $antecedents = verification($_POST['antecedents']);
    $Patient1->bindParam(14, $antecedents);
    $Obs = verification($_POST['Obs']);
    $Patient1->bindParam(15, $Obs);
    $docMed = verification($_POST['docMed']);
    $Patient1->bindParam(16, $docMed);
    $docChir = verification($_POST['docChir']);
    $Patient1->bindParam(17, $docChir);
    $Patient1->bindParam(18, $confiance1);
    $Patient1->bindParam(19, $contacte1);
    $Patient1->bindParam(20, $_POST['MP']);
    $Patient1->bindParam(21, $_POST['AC']);
    $MDV = verification($_POST['MDV']);
    $Patient1->bindParam(22, $MDV);
    $Patient1->bindParam(23, $_POST['synEntree']);
    $tradomi = verification($_POST['tradomi']);
    $Patient1->bindParam(24, $tradomi);
    $doPhyPsy = verification($_POST['doPhyPsy']);
    $Patient1->bindParam(25, $doPhyPsy);
    $Patient1->bindParam(26, $_POST['CD']);
    $Patient1->bindParam(27, $_POST['CM']);
    $Patient1->bindParam(28, $_POST['CL']);
    $Patient1->bindParam(29, $_POST['CT']);
    $Patient1->bindParam(30, $_POST['CH']);
    $Patient1->bindParam(31, $_POST['conti']);
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
?>