<?php
global $tplData;

/**
 * Šablona pro sekci registrace
 */

    if(isset($_POST['registruj']) && $tplData['jeRegistrovan']){
        ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'success',
                title: 'Registrace proběhla úspěšně',
                showConfirmButton: true,
                allowOutsideClick: false,
                confirmButtonText: `OK`,
                customClass: {
                    confirmButton: 'order-1',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("index.php?page=uvodni_strana");
                }
            });
        </script>
        <?php
    }elseif(isset($_POST['registruj']) && !$tplData['jeRegistrovan']){
        ?>
        <script type="text/javascript">
            Swal.fire({
                icon: 'error',
                title: 'Nepodařilo se registrovat uživatele!',
                showConfirmButton: true,
                allowOutsideClick: false,
                confirmButtonText: `OK`,
                customClass: {
                    confirmButton: 'order-1',
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.replace("index.php?page=registracni_strana");
                }
            });
        </script>
    <?php
    }
    ?>



<?php
if(!$tplData['jePrihlasen']){
?>
    <div class="grid grid-cols-1 justify-center items-center h-screen font-roboto">
        <form class="grid grid-cols-1 xl:grid-cols-2 sm:space-x-5 justify-center items-center bg-emerald-100 rounded-2xl space-y-3 p-5 m-10" method="POST">
            <div class="col-span-1">
                <h4 class="text-center">Údaje</h4>
                    <div class="grid">
                        <div class="grid">
                            <label for="name">Jméno:</label>
                            <input class="bg-emerald-100" type="text" name="name" id="name" placeholder="Zadejte jméno">
                        </div>
                        <div class="grid">
                            <label for="surname">Příjmení:</label>
                            <input class="bg-emerald-100" type="text" name="surname" id="surname" placeholder="Zadejte příjmení">
                        </div>
                    </div>
                    <div class="grid">
                        <label for="email">Emailová adresa:</label>
                        <input class="bg-emerald-100" type="email" name="email" id="email" placeholder="Zadejte email">
                    </div>
                    <div>
                        <div class="grid">
                            <label for="password1">Heslo:</label>
                            <input class="bg-emerald-100" type="password" name="password1" id="password1" placeholder="Zadejte heslo">
                        </div>
                        <div class="grid">
                            <label for="password2">Heslo znovu:</label>
                            <input class="bg-emerald-100" type="password" name="password2" id="password2" placeholder="Zadejte heslo znovu">
                        </div>
                    </div>
            </div>
            <div class="col-span-1">
                <h4 class="text-center">Bydliště</h4>
                <div>
                    <div class="grid">
                        <label for="street">Ulice:</label>
                        <input class="bg-emerald-100" type="text" name="street" id="street" placeholder="ulice">
                    </div>
                    <div class="grid">
                        <label for="housenumber">ČP:</label>
                        <input class="bg-emerald-100" type="number" min="1" max="1000" name="housenumber" id="housenumber" placeholder="čp">
                    </div>
                    <div class="grid">
                        <label for="psc">PSČ:</label>
                        <input class="bg-emerald-100" type="number" min="10000" max="79999" name="psc" id="psc" placeholder="psč">
                    </div>
                </div>
                <div>
                    <div class="grid">
                        <label for="city">Město:</label>
                        <input class="bg-emerald-100" type="text" name="city" id="city" placeholder="město">
                    </div>
                    <div class="grid">
                        <label for="okres">Okres:</label>
                        <input class="bg-emerald-100" list="okresy" name="okres" id="okres">
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
                            echo "<option value=''>";
                            foreach($okresy as $okres){
                                echo "<option value='$okres'>$okres";
                            }
                            ?>
                        </datalist>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" name="registruj">Registrovat</button>
                </div>
            </div>
        </form>
    </div>
<?php
}else{
?>
    <h2 class="text-center" style="padding-top: 20px;color:white">Pouze pro nepřihlášené uživatele.</h2>
<?php
}
?>
