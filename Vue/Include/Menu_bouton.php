
<div id="gauche" class="gauche">
    <div class="profile" id="space-invader">
        <img width="100%" height="100%" src="https://static.vecteezy.com/ti/vecteur-libre/p3/2318271-icone-de-profil-utilisateur-gratuit-vectoriel.jpg" alt="Profile">
    </div>
    <div class="btn-group">
        <button onclick="location.href='DPI.php'">PATIENTS</button>
        <button onclick="location.href='../Scenario/principaleEve.php'">SCENARIOS</button>
        <!-- choix du rôle -->
        <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        echo '<br>';
        if ($_SESSION["Role"] == "admin" or $_SESSION["Role"] == "prof") {
            echo "<button onclick=location.href='AjouterDPI.php'> Ajouter DPI</button>";
            // Bouton permettant d'ajouter un DPI
            echo '<br>';
            echo "<button onclick=location.href='MDF_Accueil.php'>Modifier DPI</button>";
            // Bouton permettant de modifier le DPI
            echo '<br>';
            echo "<button onclick=location.href='Corbeille.php'>Corbeille DPI</button>";
            // Bouton permettant de mettre le DPI à la corbeille
            echo '<br>';
            echo "<button onclick=location.href='FormulaireUpload.php'>Upload Image</button>";
            // Bouton permettant d'uploader une image
            echo '<br>';
            echo "<button onclick=location.href='../../Controleur/Accueil/transition.php'>Passer en mode etu</button>";
            // Bouton permettant de passer en mode etu
            echo '<br>';} // Bouton permettant d'upload une image
        if ($_SESSION["Role"] == "pseudo-etu") {echo "<button onclick=location.href='../../Controleur/Accueil/RetourMode.php'>Retour mode prof</button>";
            // Bouton permettant de retourner dans le mode prof
            echo '<br>';}
        if ($_SESSION["Role"] == "admin") {echo "<button onclick=location.href='../../Vue/Accueil/AttributionRole.php'>Attribuer Role</button>";
            // Bouton permettant d'attribuer un rôle
            echo '<br>';
            echo "<button onclick=location.href='FormulaireUnlink.php'>Supprimer Image</button>";
            // Bouton permettant de supprimer une image
            echo '<br>';
            echo "<button onclick=location.href='SupprimerPatient.php'>Supprimer DPI</button>";
            // Bouton permettant de supprimer un patient
            echo '<br>';
            echo "<button onclick=location.href='RecupCorbeille.php'>Recuperation Patient</button>";
            // Bouton permettant de récupèrer un patient
            echo '<br>';}
        $_SESSION['infosPatient']=[];
        ?>
    </div>
</div>