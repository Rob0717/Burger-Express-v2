<?php
global $tplData;

/**
 * Šablona pro sekci registrace
 */

    if(isset($_POST['registruj']) && $tplData['jeRegistrovan']){
        ?>
        <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex justify-center items-center">
                <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div class="pl-3">
                    <p class="font-bold">Uživatel registrován</p>
                    <p class="text-sm">Uživatel <?= $tplData['novyUzivatel'][0]['jmeno'] ?> <?= $tplData['novyUzivatel'][0]['prijmeni'] ?> byl úspěšně zaregistrován.</p>
                </div>
            </div>
        </div>
        <?php
    }elseif(isset($_POST['registruj']) && !$tplData['jeRegistrovan']){
        ?>
        <div id="alert_error" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-red-300 border-t-4 border-red-600 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex justify-center items-center">
                <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="pl-3">
                    <p class="font-bold">Chyba registrace</p>
                    <p class="text-sm">Nepodařilo se registrovat nového uživatele.</p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>



<?php
if(!$tplData['jePrihlasen']){
?>
    <div class="grid grid-cols-1 justify-center items-center h-screen font-roboto">
        <form class="grid grid-cols-1 xl:grid-cols-2 md:space-x-5 justify-center items-center bg-emerald-100 rounded-2xl p-5 m-10" method="POST">
            <div class="col-span-1 mb-5">
                <h4 class="text-center">Údaje</h4>
                    <div class="grid">
                        <div class="grid">
                            <label for="name">Jméno:</label>
                            <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="text" name="name" id="name" placeholder="Zadejte jméno">
                        </div>
                        <div class="grid">
                            <label for="surname">Příjmení:</label>
                            <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="text" name="surname" id="surname" placeholder="Zadejte příjmení">
                        </div>
                    </div>
                    <div class="grid">
                        <label for="email">Emailová adresa:</label>
                        <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="email" name="email" id="email" placeholder="Zadejte email">
                    </div>
                    <div>
                        <div class="grid">
                            <label for="password1">Heslo:</label>
                            <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="password" name="password1" id="password1" placeholder="Zadejte heslo">
                        </div>
                        <div class="grid">
                            <label for="password2">Heslo znovu:</label>
                            <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="password" name="password2" id="password2" placeholder="Zadejte heslo znovu">
                        </div>
                    </div>
            </div>
            <div class="col-span-1 mb-5">
                <h4 class="text-center">Bydliště</h4>
                <div class="grid">
                    <label for="street">Ulice:</label>
                    <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="text" name="street" id="street" placeholder="ulice">
                </div>
                <div class="grid">
                    <label for="housenumber">ČP:</label>
                    <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="number" min="1" max="1000" name="housenumber" id="housenumber" placeholder="čp">
                </div>
                <div class="grid">
                    <label for="psc">PSČ:</label>
                    <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="number" min="10000" max="79999" name="psc" id="psc" placeholder="psč">
                </div>


                <div class="grid">
                    <label for="city">Město:</label>
                    <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" type="text" name="city" id="city" placeholder="město">
                </div>
                <div class="grid">
                    <label for="okres">Okres:</label>
                    <input class="bg-emerald-100 border-2 border-emerald-300 rounded-md pl-1" list="okresy" name="okres" id="okres">
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
            <div class="flex justify-center items-center col-span-1 md:col-span-2">
                <button class="bg-emerald-300 p-2 hover:bg-emerald-200 text-white" type="submit" name="registruj">Registrovat</button>
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
