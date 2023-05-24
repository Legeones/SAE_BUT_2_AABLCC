<?php
session_start();
require ('../../Model/BDD/DataBase_Scenario.php');


//inspired by https://stackoverflow.com/questions/1972712/how-to-generate-random-date-between-two-dates-using-php
function randomDate($startDate, $endDate, $count = 1 ,$dateFormat = 'Y-m-d H:i:s ')
{
    // Convert the supplied date to timestamp
    $minDateString = strtotime($startDate);
    $maxDateString = strtotime($endDate);


    if ($minDateString > $maxDateString)
    {
        throw new Exception("From Date must be lesser than to date", 1);

    }

    for ($ctrlVarb = 1; $ctrlVarb <= $count; $ctrlVarb++)
    {
        $randomDate[] = mt_rand($minDateString, $maxDateString);
    }
    if (sizeof($randomDate) == 1)
    {
        $randomDate = date($dateFormat, $randomDate[0]);
        return $randomDate;
    }elseif (sizeof($randomDate) > 1)
    {
        foreach ($randomDate as $randomDateKey => $randomDateValue)
        {
            $randomDatearray[] =  date($dateFormat, $randomDateValue);
        }
        //return $randomDatearray;
        return array_values(array_unique($randomDatearray));
    }
}

function insciption($lis,$id,$eve,$deb,$fin,$nbev){
    $date = new DateTime($deb);
    $date->modify('+1 day');
    $result = $date->format('Y-m-d');


    $date2 = new DateTime($fin);
    $date2->modify('-1 day');
    $result2 = $date2->format('Y-m-d');

    if(isset($lis))
    {
        $DPIListSce=recupDPIScenarion($id);
        echo $DPIListSce;
        foreach($lis as $valeur)
        {
            $val=$eve;
            for($i = 1; $i <= $nbev; $i++){
                $rand_keys = array_rand($val);
                $rand_Dpi=array_rand($DPIListSce);
                $date_random = randomDate($result,$result2);
                insertEvenSceEtu($id,$eve[$rand_keys],$valeur,$date_random,$DPIListSce[$rand_Dpi]);
            }
        }
        header('Location: ../../Vue/Scenario/principaleEve.php');
    }else{
        header('Location: ../../Vue/Scenario/principaleEve.php');
    }
}

function desinscription($lis,$id){
    if(isset($lis))
    {
        foreach($lis as $valeur)
        {
            desinsEtuSe($id,$valeur);
        }
        header('Location: ../../Vue/Scenario/principaleEve.php');
    }
}

if($_SESSION['choixInsDes']=='inscription'){
    insciption($_POST['gout'],$_SESSION['IdScenario'],$_SESSION['eve'],$_SESSION['debut'],$_SESSION['fin'],$_SESSION['nbev']);
}else{
    desinscription($_POST['gout'],$_SESSION['IdScenario']);
}