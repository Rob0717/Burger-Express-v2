<?php
global $tplData;

/**
 * Šablona pro sekci s nabídkou
 * produktů pro uživatele
 */
?>

<?php
foreach($tplData['prod'] as $p){
    $id = $p['id'];
    if(isset($_POST["btnDoKosiku$id"]) && $tplData['jeVKosiku'] && $tplData['lzeVlozitDoKosiku']){
?>
        <div id="alert_info" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-teal-100 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex justify-center items-center">
                <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                    </svg>
                </div>
                <div class="pl-3">
                    <p class="font-bold">Zboží je již v košíku</p>
                    <p class="text-sm">Množství lze změnit v košíku.</p>
                </div>
            </div>
        </div>
<?php
    }else if(isset($_POST["btnDoKosiku$id"]) && !$tplData['jeVKosiku'] && $tplData['lzeVlozitDoKosiku']){
?>
        <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex justify-center items-center">
                <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div class="pl-3">
                    <p class="font-bold">Přidáno do košíku</p>
                    <p class="text-sm">Do košíku byl přidán produkt <?= $tplData['produkt']['nazev'] ?>.</p>
                </div>
            </div>
        </div>
<?php
    }else if(isset($_POST["btnDoKosiku$id"]) && !$tplData['jeVKosiku'] && !$tplData['lzeVlozitDoKosiku']){
?>
        <div id="alert_error" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-red-300 border-t-4 border-red-600 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex justify-center items-center">
                <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="pl-3">
                    <p class="font-bold">Nelze vložit do košíku</p>
                    <p class="text-sm">Daný produkt nemohl být vložen do košíku.</p>
                </div>
            </div>
        </div>
<?php
    }
}
?>

<?php
if(isset($tplData['upravaProduktu'])){
?>
    <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center items-center">
            <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <div class="pl-3">
                <p class="font-bold">Množství upraveno</p>
                <p class="text-sm">Množství produktu <?= $tplData['upravenyProduktNazev'] ?> bylo upraveno.</p>
            </div>
        </div>
    </div>
<?php
}
?>
<?php
if(isset($tplData['odebraniProduktu'])){
?>
    <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center items-center">
            <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <div class="pl-3">
                <p class="font-bold">Odebráno z košíku</p>
                <p class="text-sm">Produkt <?= $tplData['odebranyProduktNazev'] ?> úspěšně odebrán z košíku.</p>
            </div>
        </div>
    </div>
<?php
}
?>

<?php
if(isset($_POST['btnObjednat']) && $tplData['jeObjednano']){
    $tplData['produktRadekVTabulce'] = "";

    $tplData['cenaCelkemRadek'] = "";
?>
    <div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center items-center">
            <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
            </div>
            <div class="pl-3">
                <p class="font-bold">Objednáno</p>
                <p class="text-sm">Zboží je úspěšně objednáno.</p>
            </div>
        </div>
    </div>
<?php
}elseif(isset($_POST['btnObjednat']) && !$tplData['jeObjednano']){
?>
    <div id="alert_error" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-red-300 border-t-4 border-red-600 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
        <div class="flex justify-center items-center">
            <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </div>
            <div class="pl-3">
                <p class="font-bold">Nelze objednat</p>
                <p class="text-sm">Zboží se nepodařilo objednat.</p>
            </div>
        </div>
    </div>
<?php
}
?>

<?php if(!$tplData['jePrihlasen']){ ?>
    <h2 class="text-xl text-center font-bold font-roboto mt-5">Nabídka produktů jen pro přihlášené uživatele.</h2>
<?php }else{
    if($tplData['role'] == 2 || $tplData['role'] == 3){
?>
        <h2 class="text-xl text-center font-bold font-roboto mt-5">Nabídka produktů jen pro konzumenty.</h2>
<?php
    }else{

        if(!empty($tplData['produktRadekVTabulce'])){
?>
            <div class="bg-emerald-300 flex justify-center font-montserrat font-bold uppercase text-xl pt-4 pb-3 rounded-t-3xl ml-3 mr-3 mt-3">Košík</div>
<?php
        }
?>

        <div class="bg-emerald-500 ml-3 mr-3">
            <form method="POST">
                <table class="border-collapse w-full font-roboto">
                    <?= $tplData['produktRadekVTabulce']; ?>
                    <?= $tplData['cenaCelkemRadek']; ?>
                </table>
            </form>
        </div>

    <?= $tplData['hlavickaVsechProduktu']; ?>
    <?= $tplData['vsechnyProdukty']; ?>
    <?= $tplData['patickaVsechProduktu']; ?>
<?php   } ?>
<?php } ?>
