<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!empty($_POST['selectDPI'])){
        $_SESSION['val'] = $_POST['valueipp'];
        if (empty($_SESSION['val'])) {
            echo "<p style='color: red'>il n'y a pas de données </p>";
            // Un message d'erreur apparaît quand il n'y as pas de données
        }
    }

    if(!empty($_POST['type_categorie'])){
        $_SESSION['type_categorie'] = $_POST['type_categorie'];
    }else{
        echo "<p style='color: red'>le type de catégorie est vide</p>";
        // Un message d'erreur apparaît quand le type de la catégorie est vide
    }

    if(!empty($_POST['nbevent'])){
        $_SESSION['nbevent'] = $_POST['nbevent'];
    }else{
        echo "<p style='color: red'> les données des évènements ne sont pas remplies</p>";
        // Un message d'erreur apparaît quand les données des évènements ne sont pas remplies
    }

    if(!empty($_POST['debut'])){
        $_SESSION['debut'] = $_POST['debut'];
    }else{
        echo "<p style='color: red'>le debut d'évènement est vide </p>";
        // Un message d'erreur apparaît quand le début de l'évènement est vide
    }

    if(!empty($_POST['fin'])){
        $_SESSION['fin'] = $_POST['fin'];
    }else{
        echo "<p style='color: red'>la fin d'évènement est vide </p>";
        // Un message d'erreur apparaît quand la fin de l'événement est vide
    }

    if($_POST['debut'] >= $_POST['fin']){
        echo "<p style='color: #cc0000'> Le respect des dates n'est pas fait !</p>";
    }
}

//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//Partie evenement

//fonction qui permet d'avoir la liste des id des évènements
//                    function id_existance_aleatoire($dbh){
//                        $req = $dbh->prepare("select idevenement
//                        from evenement ");
//                        $req->execute();
//                        $donnees = array();
//                        foreach ($req as $r){
//                            $donnees[] = $r;
//
//                        }
//                        return $donnees;
//                    }


function id_existance_categorie($dbh): array  //fonction qui permet de récupérer les id des évènements par catégorie
{
    $req = $dbh->prepare("select idevenement
                        from evenement where categorie = ? ");
    $req->bindparam(1, $_POST['type_categorie']);
    $req->execute();
    $donnees = array();
    foreach ($req as $r){
        $donnees[] = $r;

    }
    return $donnees;
}



function recup_event_id($dbh): array //fonction qui récupère les id min et max des évènements
{
    $req = $dbh->prepare("select min(idevenement), max(idevenement) from evenement");
    $req->execute();
    $infos = array();
    foreach ($req as $row){
        $infos[] = $row;
    }
    return $infos;
}


/**
 * @throws Exception
 */
function recup_event($dbh): array
{ //fonction qui permet de récupérer une liste d'évènements en fonction de leur id et catégorie
    $i = $_SESSION['nbevent'];
    $k= 0;
    $donnees = recup_event_id($dbh);
    $les_ids= id_existance_categorie($dbh);
    $events = array();
    if(!empty($i)){
        while ($k != $i){
            $r = random_int($donnees[0][0], $donnees[0][1]);
            if (in_array($r, $les_ids[$k])){
                $events[] = $r;
                $k += 1;
            }
        }
    }
    return $events;
}




//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//Partie scénario


function search_idscenario($db) //fonction qui permet de trouver l'id max des scénarios
{
    $src = $db->prepare("select max(idscenario)
                        from scenario");
    $src->execute();
    $donnees = array();
    foreach ($src as $row){
        $donnees += $row;
    }
    return $donnees[0] + 1;
}


/**
 * @throws Exception
 */
function ajout_scenario($dbh): void //fonction qui permet d'ajouter des scénarios à la BBD
{
    $idscenario = search_idscenario($dbh);
    $idevents = recup_event($dbh);

    //insertion des données dans la table scenario
    $insertion = $dbh->prepare("insert into scenario (idscenario,nom, debut, fin, nbEv, createur) 
                        VALUES (?,?,?,?,?,?)");

    //paramètres pour la requête SQL
    $insertion->bindparam(1, $idscenario);
    $insertion->bindparam(2, $_POST['nom_scenario']);
    $insertion->bindparam(3, $_SESSION['debut']);
    $insertion->bindparam(4, $_SESSION['fin']);
    $insertion->bindparam(5, $_POST['nbevent']);
    $insertion->bindparam(6, $_SESSION['username']);
    $insertion->execute();

    $compt = [];


    while(sizeof($compt) != $_POST['nbevent']){ //boucle pour l'insertion de l'association des évènements avec le scénario en question
        $k = random_int(0, sizeof($idevents)-1);
        $id = $idevents[$k];
        if (!(in_array($id, $compt))){ //vérification de la donnée qui n'est pas déjà présente dans la BDD
            $insertion_event = $dbh->prepare("insert into scenarioevenement (idscenario, idevenement) VALUES (?,?)"); //insertion des données dans la BDD
            $insertion_event->bindparam(1, $idscenario); //paramètres de la requête
            $insertion_event->bindparam(2, $id);
            $insertion_event->execute();
            $compt[]+=$id;
        }else{
            throw  new ErrorException();
        }
    }

}


//------------------------------------------------------------------------------------------------------------------------------------------------------------------//



?>