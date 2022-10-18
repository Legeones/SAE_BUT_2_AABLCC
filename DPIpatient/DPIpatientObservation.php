<?php
session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="DPIpatientStyle.css" media="screen" type="text/css" />
</head>
<header>
    <img class="logo" src="https://moodle.uphf.fr/pluginfile.php/358899/mod_resource/content/1/logoIFSI.png">
</header>
<body>
<div class="global">
    <div class="gauche">
        <div class="profile" id="space-invader">
            <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg">
        </div>
        <div class="btn-group">
            <button onclick="location.href='principale.php'">PATIENTS</button>
            <button>SCENARIOS</button>
            <button>JSAISPAS</button>
        </div>
    </div>
    <script>
        function alterner(id){
            var doc = document.getElementById(id);
            if(doc.style.backgroundColor=="cornflowerblue"){
                doc.style.backgroundColor = 'white';
            } else{
                doc.style.backgroundColor = "cornflowerblue";
            }
        }
    </script>
    <?php
    if (!isset($_SESSION['cat']) || $_SESSION['cat']=='macrocible'){
        $_SESSION['cat']='macrocible';
    } else {
        $_SESSION['cat']=$_GET['categ'];
    }
    ?>
    <div class="droite">
        <form name="cat" method="get" class="btn-line">
            <input type="button" onclick="location.href='DPIpatient.php';" value="macrocible">
            <input type="button" onclick="location.href='DPIpatientObservation.php';" value="Observation médicale">
            <input type="button" onclick="location.href='DPIpatientPrescription.php';" value="Prescription">
            <input type="button" onclick="location.href='DPIpatientDiagramme.php';" value="Diagramme de soins">
            <input type="button" onclick="location.href='DPIpatientBiologie.php';" value="Biologie">
            <input type="button" onclick="location.href='DPIpatientImagerie.php';" value="Imagerie">
            <input type="button" onclick="location.href='DPIpatientCourriers.php';" value="Courriers">
        </form>
        <div class="container">
            <?php print $_GET['cat']?>
        </div>
    </div>
</div>
</body>
</html>
