<?php
require ('../../../SAE_BUT_2_AABLCC/Controleur/Scenario/Mode_Examen.php')
?>

<header id="haut">
    <form action="../../Controleur/Scenario/Mode_Examen.php" method="post" class="form_header">
        <img class="logo" src="../../Images/logoIFSI.png" alt="LogoIFSI">
        <div id="group_bt_exam" class="group_bt_exam">
            <button type="submit" value="0" id="bt1_exam" name="bt1_exam" class="bt1_exam">Mode examen</button>
            <div style="display: none" id="select" class="select">
                <select name="DPI" id="DPI_Patient">
                    <option value="defaut">--Choisir le Scenario--</option>
                    <?php
                    $lst = liste_nom_senario();
                    for($i =0;$i<sizeof($lst);$i++):?>
                        <option value="<?php echo $lst[0][$i] ?>"><?php echo $lst[0][$i] ?></option>
                    <?php endfor; ?>

                </select>

            </div>
        </div>
        <button type="button" title="Déconnexion" id="logout" class="logout" onclick="location.href='../Accueil/Deconnexion.php'"><img id="img_logout" src="../../Images/Logout.png"></button>

        <?php
            if(isset($_SESSION['exam']) && $_SESSION['exam'] == 0):
        ?>
            <script>
                const div_none = document.getElementById('select')
                const bt_exam = document.getElementById('bt1_exam')
                const body = document.body;
                bt_exam.value = 0;
                div_none.style.display = "none";
                bt_exam.style.borderColor = "#66CCCC"
                bt_exam.style.backgroundColor = "#92ecec"
                body.style.background = "linear-gradient(20deg,white,#a5f4f4)";
            </script>
        <?php endif;?>

        <?php
        if(isset($_SESSION['exam']) && $_SESSION['exam'] == 1):
            ?>
            <script>
                const div_none = document.getElementById('select')
                const bt_exam = document.getElementById('bt1_exam')
                const body = document.body;
                bt_exam.value = 1;
                div_none.style.display = "block";
                bt_exam.style.borderColor = "#f7a947"
                bt_exam.style.backgroundColor = "#feba64"
                body.style.background = "linear-gradient(20deg,white,#fcb55a)";
            </script>
        <?php endif;?>
    </form>
</header>
