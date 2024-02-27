<?php
global $tplData;

/**
 * Šablona pro administrátorskou sekci
 */

?>

<?php
if($tplData['jePrihlasen']){
    if($tplData['role'] == 1 || $tplData['role'] == 2){
?>
        <div class="bg-emerald-300 mt-2 ml-2 mr-2 font-montserrat font-bold text-xl border-2 border-emerald-200 rounded-t-2xl text-white text-center">Uživatelé</div>
        <div class='grid grid-cols-3 ml-2 mr-2 border-2 border-emerald-200 bg-emerald-300'>
            <?php
            if(isset($tplData['vsichniUzivatele'])){
                foreach($tplData['vsichniUzivatele'] as $uzivatel){
                    $o_mne = trim($uzivatel['o_mne']) == "" ? "Nebyla vložena žádná data." : trim($uzivatel['o_mne']);
                    echo "
                        <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>$uzivatel[jmeno]</div>
                        <div class='grid-cols-1 text-center border-b-2 border-emerald-200'>$uzivatel[prijmeni]</div>
                        <div class='grid-cols-1 md:grid-cols-2 text-center border-b-2 border-emerald-100'>$o_mne</div>";
                }
            }
            ?>
        </div>
            <div class="ml-2">
                <label>
                    <select name="users" onchange="showUser(<?= $tplData['role'] ?>,this.value)">
                        <option value="" selected>Zvolte osobu:</option>
                        <?php
                        if(isset($tplData['vsichniUzivatele'])){
                            foreach($tplData['vsichniUzivatele'] as $u){
                                if($tplData['role'] == 1){
                                    if($u['id_pravo'] > 1){
                                        echo "<option value='$u[id]'>$u[jmeno] $u[prijmeni]</option>";
                                    }
                                }
                                if($tplData['role'] == 2){
                                    if($u['id_pravo'] > 2){
                                        echo "<option value='$u[id]'>$u[jmeno] $u[prijmeni]</option>";
                                    }
                                }
                            }
                        }
                        ?>
                    </select>
                </label>
            </div>
        <br>
        <div id="txtHint"></div>
<?php
    }else{
?>
        <h2 class="text-xl text-center font-bold font-roboto mt-5">Pouze pro administrátory.</h2>
<?php
    }
}else{
?>
    <h2 class="text-xl text-center font-bold font-roboto mt-5">Pouze pro přihlášené.</h2>
<?php
}
?>