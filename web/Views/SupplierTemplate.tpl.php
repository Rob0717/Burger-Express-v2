<?php
global $tplData;

/**
 * Šablona pro dodavatelskou sekci
 */

?>

<?php
if((isset($tplData['role']) && $tplData['role'] % 2 == 0) || !$tplData['jePrihlasen']){
?>
    <h2 class="text-xl text-center font-bold font-roboto mt-5">Pouze pro dodavatele.</h2>
<?php
}else{
?>
    <form class="grid justify-center m-3 pb-3 space-y-5 bg-emerald-300 font-roboto bg-opacity-75 border-2 border-emerald-300 rounded-2xl" method="post" enctype="multipart/form-data">
        <h1 class="mt-3 text-center font-montserrat font-bold text-xl text-white">Nový produkt</h1>
        <div class="grid pl-1 pr-1">
            <label class="text-white" for="nazevNovy">Název produktu:</label>
            <input class="bg-emerald-100" type="text" name="nazevNovy" id="nazevNovy">
        </div>
        <div class="grid pl-1 pr-1">
            <input type="file" name="souborNovy" id="souborNovy" accept='image/jpg,image/jpeg,image/png,image/gif'>
        </div>
        <div class="grid pl-1 pr-1">
            <label class="text-white" for="cenaNovy">Cena:</label>
            <input class="text-center bg-emerald-100" type="number" name="cenaNovy" id="cenaNovy" min="50" max="1000">
        </div>
        <div class="grid pl-1 pr-1">
            <label class="text-white" for="ksNovy">Počet ks k uskladnění:</label>
            <input class="text-center bg-emerald-100" type="number" name="ksNovy" id="ksNovy" min="0" max="1000">
        </div>
        <div class="grid pl-1 pr-1">
            <label class="text-white" for="popisNovy">Popis:</label>
            <textarea class="bg-emerald-100" name="popisNovy" id="popisNovy"></textarea>
        </div>
        <input class="bg-emerald-500 pt-2 pb-2 hover:bg-emerald-400 text-white" type="submit" name="vlozNovy" id="vlozNovy" value="Uložit">
    </form>

    <?php
    if(isset($_POST['vlozNovy'])){
        if($tplData['existuje']){
    ?>
            <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Nahráno</p>
                        <p class="text-sm">Nový produkt byl úspěšně nahrán.</p>
                    </div>
                </div>
            </div>
    <?php
        }else{
    ?>
            <div id="alert_error" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-red-300 border-t-4 border-red-600 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Nelze nahrát</p>
                        <p class="text-sm">Daný produkt se nepodařilo nahrát.</p>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>

    <?php
    foreach($tplData['vsechnyProdukty'] as $produkt){
        $id_produktu = $produkt['id'];
        if(isset($_POST["btnUpravProdukt$id_produktu"])){
            ?>
            <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Produkt upraven</p>
                        <p class="text-sm">Produkt <?= $produkt['nazev'] ?> byl úspěšně upraven.</p>
                    </div>
                </div>
            </div>
            <?php
        }
        if(isset($_POST["btnOdstran$id_produktu"])){
            ?>
            <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Produkt odebrán z nabídky</p>
                        <p class="text-sm">Produkt <?= $produkt['nazev'] ?> byl úspěšně odebrán z nabídky.</p>
                    </div>
                </div>
            </div>
            <?php
        }if(isset($_POST["ulozFoto$id_produktu"]) && isset($_FILES["noveFoto$id_produktu"]["name"]) &&
            $tplData['fotoUpraveno']){
            ?>
            <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Foto upraveno</p>
                        <p class="text-sm">Foto produktu <?= $produkt['nazev'] ?> bylo úspěšně upraveno.</p>
                    </div>
                </div>
            </div>
            <?php
        }else if(isset($_POST["ulozFoto$id_produktu"]) && isset($_FILES["noveFoto$id_produktu"]["name"]) &&
            !$tplData['fotoUpraveno']){
            ?>
            <div id="alert_error" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-red-300 border-t-4 border-red-600 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Foto nezměněno</p>
                        <p class="text-sm">Foto produktu <?= $produkt['nazev'] ?> se nepodařilo změnit.</p>
                    </div>
                </div>
            </div>
            <?php
        }
        if(isset($_POST["btnUplneOdstraneni$id_produktu"])){
            ?>
            <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                <div class="flex justify-center items-center">
                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                        </svg>
                    </div>
                    <div class="pl-3">
                        <p class="font-bold">Produkt smazán</p>
                        <p class="text-sm">Produkt <?= $produkt['nazev'] ?> byl úspěšně smazán.</p>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    echo $tplData['produkty'];
}
?>