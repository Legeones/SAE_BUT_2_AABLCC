
<?php
session_start();
require '../BDD/DataBase_Core.php';


if (empty($_POST['recherche'])){
    if(isset($_SESSION['mdf'])&& $_SESSION['mdf'] != null){
        modifer($_SESSION['mdf']);
        $_SESSION['mdf'] = null;
    }
}
else {
    $_SESSION['mdf'] = $_POST['recherche'];
    for ($i = 2; $i <= 29; $i++) {
        if ($i == 17 || $i == 18) {
            $i += 1;
        }
        $name = 'val' . $i;
        $_SESSION[$name] = StockDPI()[$i];
    }
}
header('Location: MDFDPI.php');
?>
