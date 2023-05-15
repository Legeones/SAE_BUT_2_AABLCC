<?php

require ('DataBase_Core.php');
session_start();

function lstderoulanteScenario(){
    try {
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select idScenario,nom from Scenario left join ScenarioCorbeille SC on Scenario.idScenario = SC.idSCorb where createur= ? and idSCorb is null and (debut>current_date or fin<current_date)");
    $DPI->bindParam(1,$_SESSION['username']);
        $DPI->execute();
        $result = $DPI->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }
}


//fonction pour mettre un scenario dans la corbeille
function addCorbeilleSce($idS){
    try{
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO ScenarioCorbeille values (?)");
        $stmt2->bindParam(1, $idS);
        $stmt2->execute();
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }

}

//fonction pour supprimer un scenario
function supCorbeilleSce($idS){
    try{
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("delete from Scenario where idScenario=?");
        $stmt2->bindParam(1, $idS);
        $stmt2->execute();
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }

}


//fonction qui permet de recupérer les scénario d'un professeur mis dans la corbeille
function lstderoulanteScenarioCorb(){
    try {
        $DPI2 = DataBase_Creator_Unit();
        $DPI = $DPI2->prepare("select idScenario,nom from ScenarioCorbeille join Scenario S on S.idScenario = ScenarioCorbeille.idSCorb where createur= ?");
        $DPI->bindParam(1,$_SESSION['username']);
        $DPI->execute();
        $result = $DPI->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }

}

//fonction pour récupérer un scénario mis dans la corbeille
function RecupCorbeilleSce($idS){
    try{
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("delete from ScenarioCorbeille where idSCorb=?");
        $stmt2->bindParam(1, $idS);
        $stmt2->execute();
    }catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }

}
// Fonction permettant de check un scénario
function checkScenario($id){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("SELECT count(*) FROM Scenario WHERE idScenario=? and createur=?");
        $stmt2->bindParam(1, $id);
        $stmt2->bindParam(2,$_SESSION['username']);
        $stmt2->execute();
        $res= $stmt2->fetchColumn(0);
        return $res;

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}


//fonction pour récuperer les informations d'un scénario
function recupInfoScenario($id){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select nom,debut,fin,nbev from Scenario where idScenario=? and createur= ?");
    $DPI->bindParam(1,$id);
    $DPI->bindParam(2,$_SESSION['username']);
    $DPI->execute();
    $liste = array();
    foreach ($DPI as $value){
        $liste+=$value;
    }
    return $liste;
}

//fonction pour récupérer les evenement liée a un scénario
function recupEvenScenario($id)
{
    try {
        $DPI2 = DataBase_Creator_Unit();
        $DPI = $DPI2->prepare("select idEvenement from ScenarioEvenement where idScenario=? ");
        $DPI->bindParam(1, $id);
        $DPI->execute();
        $result = $DPI->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
        //echo "<img class='logo' src=$res>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }
}

//fonction pour récupérer les étudiants qui ne sont pas encore inscrit a un scenario
function lstderoulanteEtu($idS)
{
    $etu = 'etudiant';
    try {
        $DPI2 = DataBase_Creator_Unit();
        $DPI = $DPI2->prepare("select login,nom,prenom from Utilisateur where roles=? except select distinct login,nom,prenom from utilisateur left join ScenarioEtudiant SE on Utilisateur.login = SE.idU
where  idS=? order by nom,prenom;");
        $DPI->bindParam(1, $etu);
        $DPI->bindParam(2,$idS);
        $DPI->execute();
        $result = $DPI->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }
}

function lstderoulanteEtuInscr($idS)
{
    try {
        $DPI2 = DataBase_Creator_Unit();
        $DPI = $DPI2->prepare("select DISTINCT login,nom,prenom from Utilisateur join ScenarioEtudiant SE on Utilisateur.login = SE.idU where idS=? order by nom,prenom;");
        $DPI->bindParam(1,$idS);
        $DPI->execute();
        $result = $DPI->fetchAll();
        return $result;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }
}

//fonction pour affecter a un etudiant un evenement a une date pour un scenario
function insertEvenSceEtu($idS,$idEv,$idEtu,$date,$idIPP){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO ScenarioEtudiant values (?,?,?,?,?)");
        $stmt2->bindParam(1, $idS);
        $stmt2->bindParam(2, $idEtu);
        $stmt2->bindParam(3, $idEv);
        $stmt2->bindParam(4, $date);
        $stmt2->bindParam(5, $idIPP);
        $stmt2->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

}

function lstderoulCate(){
    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select distinct categorie from Evenement");
    $DPI->execute();
    return $DPI;
}

//fonction pour récupérer les dpi d'un scénario
function recupDPIScenarion($id){
    try {
        $DPI2 = DataBase_Creator_Unit();
        $DPI = $DPI2->prepare("select ipp from dpiScenario where idS=? ");
        $DPI->bindParam(1, $id);
        $DPI->execute();
        $result = $DPI->fetchAll(PDO::FETCH_COLUMN, 0);
        return $result;
        //echo "<img class='logo' src=$res>";
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();

    }
}

function insertEven($nom,$des,$cate){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("INSERT INTO Evenement values (default,?,?,?)");
        $stmt2->bindParam(1, $nom);
        $stmt2->bindParam(2, $des);
        $stmt2->bindParam(3, $cate);
        $stmt2->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }

}

function desinsEtuSe($idS,$log){
    try {
        $dbh = DataBase_Creator_Unit();
        $stmt2 = $dbh->prepare("delete from ScenarioEtudiant where idS=? and idU=?");
        $stmt2->bindParam(1, $idS);
        $stmt2->bindParam(2, $log);
        $stmt2->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage() . "<br/>";
        die();
    }
}


function lst_deroulante_nom_Scenario()
{

    $DPI2 = DataBase_Creator_Unit();
    $DPI = $DPI2->prepare("select scenario.nom
                                from scenario
                                join scenarioetudiant on scenario.idscenario = scenarioetudiant.ids where scenarioetudiant.idu = ?");
    $DPI->bindParam(1, $_SESSION['username']);
    $DPI->execute();
    return $DPI->fetchAll();

}
