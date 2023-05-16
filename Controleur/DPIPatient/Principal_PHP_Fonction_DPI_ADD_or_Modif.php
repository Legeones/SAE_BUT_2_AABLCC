<?php

require ('../../Model/BDD/DataBase_Dpi.php');

// input d'un formulaire pour les types number et texte prenant en paramètre un nom d'ID, une liste contenant tous les noms de table, un compteur, le type de input et le nom d'une session )
function formulaire($res,$lst,$i,$type,$res2){ ?>
    <div class="Groupe">
        <?php
        $label = formulaire_pas_obligatoire_affichage($lst[$i],$i); //appel a la fonction formulaire_pas_obligatoire_affichage avec en paramètre le nom de colonne et une position
        echo "<label for='$res'>  $label: </label><br>"; ?>
        <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="<?= $_SESSION[$res2] ?? '' ?>"/> <!-- creation d'un input, le value sert à mettre la valeur de la session, si elle est nulle ou n'existe pas alors value sera nulle -->
        <?php if (isset($_SESSION['lstErreur']) and comparaison($_SESSION['lstErreur'],$res) == true){ // la session lstErreur est une liste contenant les inputs vides, si un nom de colonne se trouve dedans alors les colonnes obligatoires à remplir mettront une erreur
            if (!(($i >= 11 and $i <= 16) or ($i == 21) or ($i >= 23 and $i <= 24 ))){  // tri de toutes les colonnes obligatoire à remplir pour le formulaire
            echo "<p style='color:red'>Ce champ est obligatoire </p>";
            // Ici un message d'erreur apparait lorsque le champ n'est pas remplis
        }}
        if (isset($_SESSION['lstErreur_specifique']) and comparaison($_SESSION['lstErreur_specifique'], $res) == true) {
            if ($i ==0 or $i == 8) { // autre erreur en cas de condition non valide
                echo "<p style='color:red'>Ce champ est invalide</p>";
                // Une erreur est affichée lorsque le champ n'est pas valide
            }
        }
        ?>
    </div>
<?php }

// input d'un formulaire pour les types radio prenant en paramètre un nom d'ID, une liste contenant tous les noms de table, un compteur et le nom d'une session)
function formulaire_duo_bool_radio($res,$lst,$i,$res2){?>
    <div class="Groupe1">
        <?php echo "<label for='$res'> $lst[$i]: </label><br>";
        $type = "radio"?>
        <div class="Boolean">
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="true" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 'true'):?> checked <?php endif ?>/> <!-- en cas d'erreur la page garde les champs deja remplit grâce aux sessions, donc elle se check si la session correspond bien à la valeur attendue -->
            <?php echo "<label for='$res'>OUI</label>"?>
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="false" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] != 'true'):?> checked <?php endif ?>/> <!-- en cas d'erreur la page garde les champs deja remplit grâce aux sessions, donc elle se check si la session correspond bien à la valeur attendue cependant a cause d'un bug php la valeur attendu est son contraire soit le contraire de false = true  -->
            <?php echo "<label for='$res'>NON</label>"?>
            <?php if (isset($_SESSION['lstErreur']) and comparaison($_SESSION['lstErreur'],$res) == true){
                echo "<p style='color:red'>Ce champ est obligatoire </p>";
            }?>
        </div>
    </div>

<?php }

// input d'un formulaire pour les types radio prenant en paramètre un nom d'ID, une liste contenant tous les noms de table, un compteur et le nom d'une session)
function formulaire_trio_radio($res,$lst,$i,$res2){?>
    <div class="Groupe1">
        <?php echo "<label for='$res'> $lst[$i]: </label><br>";
        $type = "radio"?>
        <div class="Boolean">
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="1" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 1):?> checked <?php endif ?>/> <!-- même principe que la fonction ci-dessus -->
            <?php echo "<label for='$res'>Autonome</label>"?>
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="2" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 2):?> checked <?php endif ?>/>
            <?php echo "<label for='$res'>Aide Partielle</label>"?>
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="3" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 3):?> checked <?php endif ?> />
            <?php echo "<label for='$res'>Aide Totale</label>"?>
            <?php if (isset($_SESSION['lstErreur']) and comparaison($_SESSION['lstErreur'],$res) == true){
                echo "<p style='color:red'>Ce champ est obligatoire </p>";
            }?>
        </div>
    </div>
<?php }

// valeur d'un DPI pour une liste déroulante
function deroulementDPI(){?>
    <select name="DPI" id="DPI_Patient">
        <option value="defaut">--Choisir le DPI à modifier--</option>
        <?php
        $der = lstderoulante2(); // prend la fonction possédant les valeurs à prendre pour la liste déroulante
        while ($row =$der->fetch(PDO::FETCH_ASSOC)) {
            unset($id, $nom, $prenom);
            $id = $row['ipp'];
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            echo "<option value='$id'> $nom $prenom </option>";

        }
        ?>
        <script>
            let res = null;
            document.getElementById('DPI_Patient').addEventListener('change',function(){
                document.getElementById('rech').value = this.value;
            });
        </script>

        <label for="rech" class="labIPP">Numéro IPP</label>
        <input class="reche" type="text" id="rech" name="recherche" value="<?php $id?>">
        <input id="b1" type="submit" value="Recherche">
    </select>
<?php }

// creation des sessions pour la modification d'un dpi prenant en paramètre le nom de la table et un intervalle entre le debut et la fin de creation
function creation_Session($table,$deb,$fin){
    for ($i = $deb; $i < $fin; $i++) {
        if ($i == 17){$i += 1;}// colonne pas prise en compte dans le formulaire
        if ($i == 18) {$i += 1;}// colonne pas prise en compte dans le formulaire
        $name = 'val' . $i;
        $_SESSION[$name] = StockDPI($table,$_POST['recherche'])[$i]; // chaque session prend leur valeur grâce à une requète sql qui prend la table et ipp d'un patient
    }
}

// creation des sessions pour l'ajout d'un dpi prenant en paramètre une intervale entre le debut et la fin de creation
function creation_Session_Add_DPI($deb,$fin){
    $lst = nameColonne('patient')[0]; // lst prend une liste de toutes les colonnes de la table patient
    for ($i = $deb; $i < $fin; $i++) {
        if ($i == 1 or $i == 17){$i += 1;} // colonne pas prise en compte dans le formulaire
        if ($i == 18) {$i += 1;} // colonne pas prise en compte dans le formulaire
        $name = 'val' . $i;
        $_SESSION[$name] = $_POST["$lst[$i]"]; // en cas d'erreur la page garde les champs deja remplit grâce aux sessions, donc elle récupère le post du nom de la colonne correspondant

    }
}

// creation des sessions pour l'ajout d'une personne de contacte prenant en paramètre un intervalle entre le debut et la fin de creation
function creation_Session_Add_contacte($deb,$fin){
    $lst = nameColonne('personnecontacte')[0]; // lst prend une liste de toutes les colonnes de la table personnecontacte
    $cpt = 1;// le debut de l'intervale ne commencent pas 1, le cpt sert donc de démarrage
    for ($i = $deb; $i < $fin; $i++) {
        $name = 'val' . $i;
        $_SESSION[$name] = $_POST["$lst[$cpt]".'ct']; // en cas d'erreur la page garde les champs deja remplit grâce aux sessions, donc elle récupère le post du nom de la colonne correspondant
        $cpt += 1;

    }
}

// creation des sessions pour l'ajout d'une personne de confiance prenant en paramètre un intervalle entre le debut et la fin de creation
// même principe que la fonction creation_Session_Add_contacte
function creation_Session_Add_confiance($deb,$fin){
    $lst = nameColonne('personneconfiance')[0];
    $cpt = 1;
    for ($i = $deb; $i < $fin; $i++) {
        $name = 'val' . $i;
        $_SESSION[$name] = $_POST["$lst[$cpt]".'cf'];
        $cpt += 1;

    }
}

// cette fonction sert à mettre null à toutes les sessions
function reset_session(){
    for ($i = 0; $i<40; $i++){
        $res = 'val' .$i;
        $_SESSION[$res] = null;
    }
}


// cette fonction sert à voir si un élement se trouve dans la liste avec comme paramètre une liste et un élément, elle retourne un boolean ou nul si la liste est nulle
function comparaison($lst,$elt){
    $bool = false;
    if ($lst == null) return null;
    for ($i = 0 ; $i<sizeof($lst); $i++){
        if ($lst[$i] == $elt){
            $bool = true;
        }
    }
    return $bool;
}

// cette fonction sert à ajouter une étoile pour chaque input non obligatoire
function formulaire_pas_obligatoire_affichage($elt,$i){
    if (($i >= 11 and $i <= 16) or ($i == 21) or ($i >= 23 and $i <= 24 )){ // tri de toutes les colonnes pas obligatoire à remplir pour le formulaire
        return '*'.$elt;
    }
    else {return $elt;}
}

function commencementIpp ($val){
    $nb = str_split((string)$val);
    $twofirst =  ($nb[0] . $nb[1]);
    return (int) $twofirst;
}

// cette fonction sert à stoker les erreurs dans une liste avec en entrée les intervalles du dpi de la personne de contact et de confiance
function erreur ($debDPI, $finDPI, $debCont, $finCont, $debConf, $finConf){
    $erreur = array(); // liste d'erreur en cas de vide sur le formulaire
    $erreur_specifique = array();// liste d'erreur en cas de containte
    $lst = nameColonne('patient')[0]; // lst prend une liste de toutes les colonnes de la table patient
    for ($i = $debDPI; $i <$finDPI ; $i++){
        if ($i == 1 or $i == 17){$i += 1;}
        if ($i == 18) {$i += 1;}
        if (!empty($_POST[$lst[$i]]) and $i == 0){ // si l'ipp n'est pas vide (i == 0 c'est l'ipp dans le formulaire)
            if ((((floor(log($_POST[$lst[0]], 10)) + 1) < 10) or  ((floor(log($_POST[$lst[0]], 10)) + 1) > 13)) or (commencementIpp($_POST[$lst[0]]) != 80) or comparaison(getLstIPP(),$_POST[$lst[0]]) == true){$erreur_specifique[] = $lst[0];}} // le nom de colonne est ajouté dans la liste si l'ipp n'est pas entre l'intervalle or si elle existe dejà (verifier grace a la fonction compare)
        if (!empty($_POST[$lst[$i]]) and $i == 8){ // meme principe que pour ci-dessus
            if (($_POST[$lst[8]] < 10000 or  $_POST[$lst[8]] > 99999)){$erreur_specifique[] = $lst[8];}
        }
        if (empty($_POST["$lst[$i]"])){
            if ((!(($i >= 11 and $i <= 16) or ($i == 21) or ($i >= 23 and $i <= 24 )))){
                $erreur[] = $lst[$i];
            }
        }
    }
    $lst1 = nameColonne('personnecontacte')[0];
    $cptcontacte = 1;
    for ($t = $debCont; $t <$finCont ; $t++){
        if (empty($_POST["$lst1[$cptcontacte]".'ct'])){
            $erreur[] = $lst1[$cptcontacte].'ct'; // le nom de colonne.ct pour éviter de mélanger les mêmes noms de colonne est mis dans la liste
        }
        $cptcontacte +=1;
    }
    $lst2 = nameColonne('personneconfiance')[0];
    $cptconfiance = 1;
    for ($k = $debConf; $k <$finConf ; $k++){
        if (empty($_POST["$lst2[$cptconfiance]".'cf'])){
            $erreur[] = $lst2[$cptconfiance].'cf';
        }
        $cptconfiance+=1;
    }
    return [$erreur, $erreur_specifique]; // retourne les 2 listes

}


?>