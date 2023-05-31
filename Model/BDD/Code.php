<?php

//Partie evenement

//fonction qui permet d'avoir la liste des id des évènements
function id_existance_aleatoire($dbh){
    $req = $dbh->prepare("select idevenement
    from evenement except select idevenement from evenement where categorie = ?");
    $req->bindparam(1, $_POST['type_categorie']);
    $req->execute();
    $donnees = array();
    foreach ($req as $r){
        $donnees[] = $r;

    }
    return $donnees;
}


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
    $j = $_SESSION['nbevent_alea'];
    $k= 0;
    $donnees = recup_event_id($dbh);
    $les_ids= id_existance_categorie($dbh);
    $events_cat = array();
    if($les_ids != []){
        if(!empty($i)){
            while ($k != $i){
                $r = random_int($donnees[0][0], $donnees[0][1]);
                if (in_array($r, $les_ids[$k])){
                    $events_cat[] = $r;
                    $k += 1;
                }
            }
        }
    }

    $k = 0;
    $les_ids = id_existance_aleatoire($dbh);
    $events_alea = array();
    if($les_ids != []){
        if(!empty($j)){
            while($k != $j){
                $r = random_int($donnees[0][0], $donnees[0][1]);
                if (in_array($r, $les_ids[$k])){
                    $events_alea[] = $r;
                    $k += 1;
                }
            }
        }
    }
    foreach ($events_alea as $row){
        $events_cat[]+= $row;
    }
    return  $events_cat;
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
    $dpi = $_SESSION['values'];
    $idscenario = search_idscenario($dbh);
    $idevents = recup_event($dbh);
    $nbevents = $_POST['nbevent']+$_POST['nbevent_alea'];
    //insertion des données dans la table scenario
    $insertion = $dbh->prepare("insert into scenario (idscenario,nom, debut, fin, nbEv, createur) 
                        VALUES (?,?,?,?,?,?)");

    //paramètres pour la requête SQL
    $insertion->bindparam(1, $idscenario);
    $insertion->bindparam(2, $_POST['nom_scenario']);
    $insertion->bindparam(3, $_SESSION['debut']);
    $insertion->bindparam(4, $_SESSION['fin']);
    $insertion->bindparam(5, $nbevents);
    $insertion->bindparam(6, $_SESSION['username']);
    $insertion->execute();

    $compt = [];
    $k=0;
    while(sizeof($compt) < $nbevents){ //boucle pour l'insertion de l'association des évènements avec le scénario en question
        //$k = random_int(0, sizeof($idevents)-1);
        $id = $idevents[$k];
        //vérification de la donnée qui n'est pas déjà présente dans la BDD
        $insertion_event = $dbh->prepare("insert into scenarioevenement (idscenario, idevenement) VALUES (?,?)"); //insertion des données dans la BDD
        $insertion_event->bindparam(1, $idscenario); //paramètres de la requête
        $insertion_event->bindparam(2, $id);
        $insertion_event->execute();

        $compt[]+=$id;
        $k += 1;



    }

    $b= 0;
    while($b < sizeof($dpi)){
        $insert = $dbh->prepare("insert into dpiScenario (ipp, idS) values (?,?)");
        $insert->bindparam(1, $dpi[$b]);
        $insert->bindparam(2, $idscenario);
        $insert->execute();
        $b += 1;
    }
    echo "<P style='color: green'>l'ajout a été effectué</p>";
}


//------------------------------------------------------------------------------------------------------------------------------------------------------------------//
//DPI
function lst_dpi($dbh){
    try{
        $req= $dbh->prepare("select ipp, nom, prenom from patient
        Left join corbeille on patient.ipp = corbeille.ippcorb
        where ippcorb is null order by nom, prenom");
        $req->execute();
        $rs = $req->fetchAll();
        return $rs;
    }catch (PDOException $e){
        print "Erreur" . $e->getmessage() . "<br>";
        die();
    }
}

//function recherche_dpi($dbh, $informations, $les_dpi_add){
//    $les_dpi = lst_dpi($dbh);
//    foreach ($les_dpi as $value){
//        if(!(in_array($informations, $les_dpi_add))){
//            if($value[0] == $informations[0] && $value[1] == $informations[1]){
//                $les_dpi_add += $informations;
//            }else{
//               echo "<p style='color: #cc0000'>Ce patient n'existe pas </p>";
//               echo $informations[0] . $informations[1];
//            }
//        }else{
//            echo "<p style='color: #cc0000'>Ce patient à déjà été ajouté</p>";
//            header("refresh:10");
//            exit();
//        }
//
//    }
//}


?>
