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
            /*
            The function alterner permit to the element with ID to change of background color
             */
            var doc = document.getElementById(id);
            if(doc.style.backgroundColor=="cornflowerblue"){
                doc.style.backgroundColor = 'white';
            } else{
                doc.style.backgroundColor = "cornflowerblue";
            }
        }
    </script>
    <div class="droite">
        <form id="cat" name="cat" method="get" class="btn-line">
            <input type="button" onclick="location.href='DPIpatient.php';" value="macrocible">
            <input type="button" onclick="location.href='DPIpatientObservation.php';" value="Observation médicale">
            <input type="button" onclick="location.href='DPIpatientPrescription.php';" value="Prescription">
            <input type="button" onclick="location.href='DPIpatientDiagramme.php';" value="Diagramme de soins">
            <input type="button" onclick="location.href='DPIpatientBiologie.php';" value="Biologie">
            <input type="button" onclick="location.href='DPIpatientImagerie.php';" value="Imagerie">
            <input type="button" onclick="location.href='DPIpatientCourriers.php';" value="Courriers">
        </form>
        <div class="container">
            <div>
                <h2>Données administratives</h2>
            </div>
            <div>
                <h2>Données sociales</h2>
            </div>
            <div>
                <h2>Infos médicales</h2>
            </div>
            <div>
                <h2>Données médicales</h2>
            </div>
            <div>
                <h2>Traitement à domicile</h2>
            </div>
            <div>
                <h2>Macrocible d'entrée</h2>
                <h3>Synthèse d'entrée</h3>
                <table>
                    <tbody>
                    <tr>
                        <td>Mobilité</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Alimentation</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Hygiène corporelle</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Elimination</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <td>Habillement</td>
                        <td>Oui</td>
                    </tr>
                    </tbody>
                </table>
                <p>Légende : 1 autonome / 2 avec aide partielle  / 3 avec aide totale</p>
            </div>


        </div>
    </div>
</div>
</body>
</html>
