<?php
require "RecupInfoBDD_AjouterDPI.php";

function formulaire($res,$lst,$i,$type,$res2){ ?>
    <div class="Groupe">
        <?php
        $label = formulaire_pas_obligatoire_affichage($lst[$i],$i);
        echo "<label for='$res'>  $label: </label><br>"; ?>
        <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="<?= $_SESSION[$res2] ?? '' ?>"/>
        <?php if (empty($res2)){echo "<p style='color:red'>Ce champ est obligatoire</p>";} ?>
        <?php if (isset($_SESSION['lstErreur']) and comparaison($_SESSION['lstErreur'],$res) == true){
            if (!(($i >= 11 and $i <= 16) or ($i == 21) or ($i >= 23 and $i <= 24 ))){
            echo "<p style='color:red'>Ce champ est obligatoire </p>";
        }} ?>
    </div>
<?php }

function formulaire_duo_bool_radio($res,$lst,$i,$res2){?>
    <div class="Groupe1">
        <?php echo "<label for='$res'> $lst[$i]: </label><br>";
        $type = "radio"?>
        <div class="Boolean">
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="true" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 'true'):?> checked <?php endif ?>/>
            <?php echo "<label for='$res'>OUI</label>"?>
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="false" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] != 'true'):?> checked <?php endif ?>/>
            <?php echo "<label for='$res'>NON</label>"?>
            <?php if (isset($_SESSION['lstErreur']) and comparaison($_SESSION['lstErreur'],$res) == true){
                echo "<p style='color:red'>Ce champ est obligatoire </p>";
            }?>
        </div>
    </div>

<?php }

function formulaire_trio_radio($res,$lst,$i,$res2){?>
    <div class="Groupe1">
        <?php echo "<label for='$res'> $lst[$i]: </label><br>";
        $type = "radio"?>
        <div class="Boolean">
            <input id="<?=$res?>" type="<?=$type?>" name="<?=$res?>" value="1" <?php if(isset($_SESSION[$res2])&&$_SESSION[$res2] == 1):?> checked <?php endif ?>/>
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


function deroulementDPI(){?>
    <select name="DPI" id="DPI_Patient">
        <option value="defaut">--Choisir le DPI à modifier--</option>
        <?php
        $der = lstderoulante2();
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

function creation_Session($table,$deb,$fin){
    for ($i = $deb; $i < $fin; $i++) {
        if ($i == 17){$i += 1;}
        if ($i == 18) {$i += 1;}
        $name = 'val' . $i;
        $_SESSION[$name] = StockDPI($table,$_POST['recherche'])[$i];
    }
}

function creation_Session_Add_DPI($deb,$fin){
    $lst = nameColonne('patient')[0];
    for ($i = $deb; $i < $fin; $i++) {
        if ($i == 17){$i += 1;}
        if ($i == 18) {$i += 1;}
        $name = 'val' . $i;
        $_SESSION[$name] = $_POST["$lst[$i]"];

    }
}

function creation_Session_Add_contacte($deb,$fin,){
    $lst = nameColonne('personnecontacte')[0];
    $cpt = 1;
    for ($i = $deb; $i < $fin; $i++) {
        $name = 'val' . $i;
        $_SESSION[$name] = $_POST["$lst[$cpt]".'ct'];
        $cpt += 1;

    }
}

function creation_Session_Add_confiance($deb,$fin,){
    $lst = nameColonne('personneconfiance')[0];
    $cpt = 1;
    for ($i = $deb; $i < $fin; $i++) {
        $name = 'val' . $i;
        $_SESSION[$name] = $_POST["$lst[$cpt]".'cf'];
        $cpt += 1;

    }
}



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

function formulaire_pas_obligatoire_affichage($elt,$i){
    if (($i >= 11 and $i <= 16) or ($i == 21) or ($i >= 23 and $i <= 24 )){
        return '*'.$elt;
    }
    else {return $elt;}
}


function erreur ($debDPI, $finDPI, $debCont, $finCont, $debConf, $finConf){
    $erreur = array();
    $lst = nameColonne('patient')[0];
    for ($i = $debDPI; $i <$finDPI ; $i++){
        if ($i == 17){$i += 1;}
        if ($i == 18) {$i += 1;}
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
            $erreur[] = $lst1[$cptcontacte].'ct';
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
    return $erreur;

}
?>