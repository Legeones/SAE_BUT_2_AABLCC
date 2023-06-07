<?php
session_start();

function recuperation_id_scenario_via_creator($dbh, $no_scenario){
    $req = $dbh->prepare("select idScenario
from Scenario left join ScenarioCorbeille SC on Scenario.idScenario = SC.idSCorb
where nom = ? and createur = ?");
    $req->bindparam(1, $no_scenario);
    $req->bindparam(2, $_SESSION["username"]);
    $req->execute();
    return json_encode($req->fetchAll());
}

function recuperation_events_via_user_and_scenario($dbh,$no_scenario, $no_etudiant){
    $scenario = recuperation_id_scenario_via_creator($dbh, $no_scenario);
    $req = $dbh->prepare("select *
    from scenarioetudiant join evenement e on scenarioetudiant.ide = e.idevenement
    join patient p on scenarioetudiant.idipp = p.ipp
    where idS=? and idu=?");
    $req->bindparam(1,$scenario); //$_POST["nom_scenario"]);
    $req->bindparam(2,$no_etudiant);//$_POST["nom_etudiant"]);
    $req->execute();
    $res = $req->fetchAll();
    return json_encode($res);
}
