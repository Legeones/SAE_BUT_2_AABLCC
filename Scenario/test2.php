<?php

session_start();

$date = new DateTime($_SESSION['debut']);
$date->modify('+1 day');
$result = $date->format('Y-m-d');


$date2 = new DateTime($_SESSION['fin']);
$date2->modify('-1 day');
$result2 = $date2->format('Y-m-d');

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



$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input);
echo $input[$rand_keys] . "\n";

?>



