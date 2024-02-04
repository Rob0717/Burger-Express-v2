<?php
global $tplData;

/**
 * Šablona pro přihlašovací sekci / uživatelskou sekci
 */

if(isset($_POST['prihlas']) && $tplData['prihlaseniUspesne']){
    ?>
    <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center items-center">
            <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <div class="pl-3">
                <p class="font-bold">Přihlášeno</p>
                <p class="text-sm">Vítáme uživatele <?= $tplData['jmenoPrihlaseny'] ?> <?= $tplData['prijmeniPrihlaseny'] ?>.</p>
            </div>
        </div>
    </div>
    <?php
}elseif(isset($_POST['prihlas']) && !$tplData['prihlaseniUspesne']){
    ?>
    <div id="alert_error" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-red-300 border-t-4 border-red-600 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center items-center">
            <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="pl-3">
                <p class="font-bold">Chyba přihlašování</p>
                <p class="text-sm">Nesprávné přihlašovací údaje.</p>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
if(isset($_POST['zmenHeslo']) && $tplData['hesloZmeneno']){
        ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Heslo úspěšně změněno',
            });
        </script>
        <?php
}else if(isset($_POST['zmenHeslo']) && !$tplData['hesloZmeneno']){
?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Heslo se nepodařilo změnit!',
        });
    </script>
<?php
}
?>

<?php if(!$tplData['jePrihlasen']){ ?>
    <div class="flex justify-center items-center h-screen font-roboto">
        <form class="grid justify-center items-center bg-emerald-100 rounded-2xl space-y-3 p-5" method="POST">
            <div>
                <div class="grid">
                    <label for="email">E-mail:</label>
                    <input class="bg-emerald-100" type="text" name="email" id="email" placeholder="Zadejte e-mail">
                </div>
            </div>
            <div>
                <div class="grid">
                    <label for="heslo">Heslo:</label>
                    <input class="bg-emerald-100" type="password" name="heslo" id="heslo" placeholder="Zadejte heslo">
                </div>
            </div>
            <div class="flex justify-center">
                <button class="bg-emerald-300 p-2 hover:bg-emerald-200" type="submit" name="prihlas">Přihlásit</button>
            </div>
        </form>
    </div>
<?php }else{ ?>
    <div>
        <form method="POST">
            <h2 style="color: white;padding-top: 20px">
                Uživatelská sekce
                <button type="submit" name="odhlas">
                    Odhlásit se
                </button>
            </h2>
        </form>

        <div class="bg-emerald-200 border-2 border-emerald-300 m-1 p-1 rounded-2xl font-roboto">
            <form class="grid justify-center md:justify-center items-center pl-3 space-x-2 space-y-3" method="POST">
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="jmeno">Jméno:</label>
                    <input class="text-center" id="jmeno" name="jmeno" type="text" value="<?= $tplData['jmenoPrihlaseny'] ?>">
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="prijmeni">Příjmení:</label>
                    <input class="text-center" id="prijmeni" name="prijmeni" type="text" value="<?= $tplData['prijmeniPrihlaseny'] ?>">
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="e-mail">E-mail:</label>
                    <input class="text-center" id="e-mail" name="e-mail" type="email" value="<?= $tplData['emailPrihlaseny'] ?>">
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="mesto">Město:</label>
                    <input class="text-center" id="mesto" name="mesto" type="text" value="<?= $tplData['mestoPrihlaseny'] ?>">
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="okres">Okres:</label>
                    <input class="text-center" list="okresy" value='<?= $tplData['okresPrihlaseny'] ?>' name="okres" id="okres">
                    <datalist id="okresy">
                        <?php
                        $okresy = array("Benešov","Beroun","Blansko","Brno-město","Brno-venkov","Bruntál",
                            "Břeclav","Česká Lípa","České Budějovice","Český Krumlov","Děčín","Domažlice",
                            "Frýdek-Místek","Havlíčkův Brod","Hodonín","Hradec Králové","Cheb","Chomutov",
                            "Chrudim","Jablonec nad Nisou","Jeseník","Jičín","Jihlava","Jindřichův Hradec",
                            "Karlovy Vary","Karviná","Kladno","Klatovy","Kolín","Kroměříž","Kutná Hora",
                            "Liberec","Litoměřice","Louny","Mělník","Mladá Boleslav","Most","Náchod",
                            "Nový Jičín","Nymburk","Olomouc","Opava","Ostrava-město","Pardubice","Pelhřimov",
                            "Písek","Plzeň-jih","Plzeň-město","Plzeň-sever","Praha-východ","Praha-západ",
                            "Prachatice","Prostějov","Přerov","Příbram","Rakovník","Rokycany","Rychnov nad Kněžnou",
                            "Semily","Sokolov","Strakonice","Svitavy","Šumperk","Tábor","Tachov","Teplice","Trutnov",
                            "Třebíč","Uherské Hradiště","Ústí nad Labem","Ústí nad Orlicí","Vsetín","Vyškov","Zlín",
                            "Znojmo","Žďár nad Sázavou");
                        foreach($okresy as $okres){
                            echo "<option class='text-center' value='$okres'>$okres";
                        }
                        ?>
                    </datalist>
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="ulice">Ulice:</label>
                    <input class="text-center" id="ulice" name="ulice" type="text" value="<?= $tplData['ulicePrihlaseny'] ?>">
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="cislopopisne">Číslo popisné:</label>
                    <input class="text-center" type="number" min="1" max="1000" name="cislopopisne" id="cislopopisne" value="<?= $tplData['cpPrihlaseny'] ?>">
                </div>
                <div class="flex justify-center items-center">
                    <label class="mr-3" for="smerovacicislo">PSČ:</label>
                    <input class="text-center" type="number" min="10000" max="79999" name="smerovacicislo" id="smerovacicislo" value="<?= $tplData['pscPrihlaseny'] ?>">
                </div>

                <div class="flex justify-center items-center">
                    <input class="bg-emerald-300 w-full" type="submit" name="ulozitUdaje" value="Uložit údaje">
                </div>

            </form>

                <div class="mt-3 mb-3">
                    <label for="role">Role:</label>
                    <input class="text-center" readonly disabled id="role" type="text" value="<?=$tplData['nazevPravoPrihlaseny']?>" >
                </div>

            <form class="grid justify-start space-y-1" method="POST">
                <div>
                    <label for="stareHeslo">Současné heslo:</label>
                    <input type="password" id="stareHeslo" name="stareHeslo">
                </div>

                <div>
                    <label for="noveHeslo">Nové heslo:</label>
                    <input type="password" id="noveHeslo" name="noveHeslo">
                </div>

                <div>
                    <label for="noveHesloZnovu">Nové heslo znovu:</label>
                    <input type="password" id="noveHesloZnovu" name="noveHesloZnovu">
                </div>

                <div>
                    <input class="bg-emerald-300 w-full" type="submit" name="zmenHeslo" value="Změnit heslo">
                </div>
            </form>
        </div>
    </div>

    <?php if($tplData['role'] != 2 && $tplData['role'] != 3){ ?>
        <div class="container">
            <h2 style="color: white;padding-top: 20px;">Moje Objednávky</h2>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-responsive">
                    <tr>
                        <th>ID Objednávky</th><th>Název produktu</th><th>Počet ks</th>
                    </tr>
                    <?= $tplData['objednavkyRadek']; ?>
                </table>
            </div>
        </div>
    <?php } ?>

    <script src="libraries/jquery/dist/jquery.slim.min.js"></script>
    <link rel="stylesheet" href="libraries/summernote/summernote-lite.min.css">
    <script src="libraries/summernote/summernote-lite.min.js"></script>

    <div class="container">
        <h2 style="color: white;padding-top: 20px;">O mně</h2>
    </div>
    <div style="background-color: #b9b9b9; padding: 0;" class="container">
        <form method="post">
                <textarea style="color: white" id="summernote" name="obsah"></textarea>
            <label for="summernote"></label>
            <div class="container">
                <button type="submit" name="uloz" class="container btn btn-secondary"><b>Ulož</b></button>
            </div>
        </form>
    </div>
    <script>
        $('#summernote').summernote({
            placeholder: 'O mně',
            tabSize: 2,
            height: 250,
            toolbar: [
                ['style', ['bold', 'italic', 'clear']],
                ['fontsize', ['fontsize']],
            ],
        });
    </script>

    <?php
    if(isset($_POST['uloz'])){
    ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Popisek byl úspěšně uložen',
            })
        </script>
    <?php
    }
    ?>

<?php } ?>
