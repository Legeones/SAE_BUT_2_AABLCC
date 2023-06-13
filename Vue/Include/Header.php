<?php
require ('../../Controleur/Scenario/Mode_Examen.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<header id="haut">
    <p id="test"></p>
    <form action="../../Controleur/DPIPatient/actionPrincipale.php" method="get" class="form_header">
        <img class="logo" src="../../Images/logoIFSI.png" alt="LogoIFSI">
        <div id="group_bt_exam" class="group_bt_exam">
            <button type="submit" value="1" id="bt1_exam" name="bt1_exam" class="bt1_exam">Mode examen</button>
            <button style="display: none" type="submit" value="1" id="bt1_examOn" name="bt1_examOn" class="bt1_examOn">Mode examen</button>
            <div style="display: none" id="select" class="select">
                <select name="DPI" id="DPI_Patient">
                    <?php
                    if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof"){
                        $lst = liste_full_nom_senario();
                    }else {
                        $lst = liste_nom_senario();
                    }?>
                    <option value="defaut">--Choisir le Scenario--</option>;
                    <?php for($i =0;$i<sizeof($lst);$i++){?>
                        <option value="<?php echo $lst[$i][0] ?>"><?php echo $lst[$i][0] ?></option>
                    <?php } ?>
                </select>
            </div>
            <?php if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof"){ ?>
                <div style="display: none" id="select2" class="select2">
                    <select  name="DPI" id="DPI_Patient2">
                        <option value="defaut">--Choisir l'étudiant--</option>;
                    </select>
                </div>
            <?php } ?>
            <button style="display: none" type="submit" id="bt_affiche_dpi" name="bt_affiche_dpi">Valider</button>
        </div>
        <button type="button" title="Déconnexion" id="logout" class="logout" onclick="location.href='../Accueil/Deconnexion.php'"><img id="img_logout" src="../../Images/Logout.png"></button>
    </form>
    <script defer src="../../Controleur/DPIPatient/script_principal_dpi.js"></script>

</header>
