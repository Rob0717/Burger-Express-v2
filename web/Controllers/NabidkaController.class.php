<?php

namespace application\Controllers;
use application\Models\MyDatabaseModel;

/**
 * Kontroler nabídky produktů s možností přidání
 * do košíku a následným objednáním
 * @author Robert Onder
 */
class NabidkaController implements IController{

    /** @var MyDatabaseModel  */
    private MyDatabaseModel $db;

    public function __construct(){
        $this->db = new MyDatabaseModel();
    }

    /**
     * @param string $pageTitle
     * @return array
     */
    public function show(string $pageTitle): array{
        global $tplData;
        $tplData = [];
        /** Titulek stránky */
        $tplData['title'] = $pageTitle;
        /** Titulek stránky přihlášeného uživatele pro uživatelskou sekci */
        $tplData['prihlasenTitle'] = $this->db->jeUzivatelPrihlasen() ? " Profil" : " Přihlášení";
        $tplData['jePrihlasen'] = $this->db->jeUzivatelPrihlasen();
        $tplData['prihlasenyUzivatel'] = $this->db->ziskejDataUzivatele();
        if($tplData['jePrihlasen']){
            /** Získání práva, pokud je uživatel přihlášen */
            $tplData['role'] = $this->db->ziskejDataUzivatele()['id_pravo'];
        }
        /** Deklarace proměnných daného kontroleru pro danou šablonu */
        $tplData['produkty'] = $this->db->vratProdukty();
        $tplData['produktRadekVTabulce'] = "";
        $tplData['cenaCelkemRadek'] = "";
        $tplData['cenaCelkem'] = 0;
        $tplData['jeVKosiku'] = false;
        $tplData['jeObjednano'] = false;
        $tplData['hlavickaVsechProduktu'] = "<div class='grid grid-cols-2 lg:grid-cols-3'>";
        $tplData['patickaVsechProduktu'] = "</div>";
        $tplData['vsechnyProdukty'] = "";
        $tplData['lzeVlozitDoKosiku'] = false;

        /** Pokud je uživatel přihlášen, vytvořím košík, popřípadě
         *  získám neodeslanou objednávku
         */
        if($tplData['jePrihlasen']){
            $tplData['neodeslanaObjednavka'] = $this->db->vratVytvorenouNeodeslanouObjednavku();
            if(empty($tplData['neodeslanaObjednavka'])){
                $this->db->vytvorObjednavku();
                $tplData['neodeslanaObjednavka'] = $this->db->vratVytvorenouNeodeslanouObjednavku();
            }
            $tplData['id_neodeslanaObjednavka'] = $tplData['neodeslanaObjednavka']['id'];

            /** Správa produktů v sekci nabídka */
            $tplData['prod'] = $this->db->vratProdukty();
            foreach($tplData['prod'] as $p){
                $idp = $p['id'];
                if(isset($_POST["btnDoKosiku$idp"]) && isset($_POST['id_produkt']) && isset($_POST['uskladneno_ks'])){
                    $tplData['produkt'] = $this->db->vratProdukt($_POST['id_produkt']);
                    $tplData['produktZKosiku'] = $this->db->vratProduktZKosiku($tplData['id_neodeslanaObjednavka'],$_POST['id_produkt']);
                    if(empty($tplData['produktZKosiku'])){
                        $tplData['jeVKosiku'] = false;
                        if($tplData['produkt']['uskladneno_ks'] > 0){
                            $tplData['lzeVlozitDoKosiku'] = true;
                            $tplData['vlozenoDoKosiku'] = $this->db->vlozDoKosiku($_POST['id_produkt']);
                        }else{
                            $tplData['lzeVlozitDoKosiku'] = false;
                        }
                    }else{
                        if($tplData['produkt']['uskladneno_ks'] > 0) {
                            $tplData['lzeVlozitDoKosiku'] = true;
                            $tplData['jeVKosiku'] = true;
                        }
                    }
                }
            }

            /** Správa košíku */
            $produkty = $this->db->vratProdukty();
            foreach($produkty as $produkt) {
                $produktID = $produkt['id'];
                if(isset($_POST["upravit$produktID"])) {
                    $tplData['upravaProduktu'] = $_POST["upravit$produktID"];
                    $tplData['upravenyProduktNazev'] = $produkt['nazev'];
                    $this->db->upravProduktVKosiku($_POST['id_objednavka'],$produktID,$_POST["pocet_ks$produktID"]);
                }
                if(isset($_POST["odebrat$produktID"])){
                    $tplData['odebraniProduktu'] = $_POST["odebrat$produktID"];
                    $tplData['odebranyProduktNazev'] = $produkt['nazev'];
                    $this->db->odeberProduktZKosiku($_POST['id_objednavka'],$produktID);
                }
            }

            /** Výpis košíku */
            $tplData['produktyVKosiku'] = $this->db->vratProduktyZKosiku($tplData['neodeslanaObjednavka']['id']);
            if(!empty($tplData['produktyVKosiku'])){
                foreach($tplData['produktyVKosiku'] as $produkt){
                    $id = $produkt['id_produkt'];
                    $ziskanyProdukt = $this->db->vratProdukt($id);
                    if($ziskanyProdukt['uskladneno_ks'] != 0){
                        $tplData['produktRadekVTabulce'] .=
                            "<tr class='bg-emerald-300'>
                                 <td class='pl-3 flex items-center'>
                                    <div class='grid'>
                                        <img class='w-24 rounded-t-2xl' src='resources/$ziskanyProdukt[foto]' alt='$ziskanyProdukt[foto]'>
                                        <div class='grid'>
                                            <div class='flex justify-around bg-emerald-100 rounded-b-xl'>
                                                <input class='bg-emerald-100 rounded-bl-xl w-14' type='number' name='pocet_ks$produkt[id_produkt]' min='1' max='$ziskanyProdukt[uskladneno_ks]' value='$produkt[pocet_ks]'>
                                                <input type='hidden' name='id_objednavka' value='$produkt[id_objednavka]'>
                                                <button type='submit' name='upravit$produkt[id_produkt]' value='$ziskanyProdukt[id]'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                                        <path stroke-linecap='round' stroke-linejoin='round' d='m4.5 12.75 6 6 9-13.5' />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                 </td>
                                 <td>$ziskanyProdukt[nazev]</td>
                                 <td>$ziskanyProdukt[cena] Kč</td>
                                 <td>
                                    <button type='submit' name='odebrat$produkt[id_produkt]' value='$produkt[id_produkt]'>
                                        <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                            <path stroke-linecap='round' stroke-linejoin='round' d='m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                                        </svg>
                                    </button>
                                 </td>
                             </tr>
                             <tr class='bg-emerald-300 mb-3'>
                                <td></td>      
                                <td></td>
                                <td></td>   
                                <td></td> 
                             </tr>";

                    $tplData['cenaCelkem'] += $produkt['pocet_ks'] * $ziskanyProdukt['cena'];
                    $tplData['cenaCelkemRadek'] =
                        "<tr class='bg-emerald-300'>
                            <td class='pl-3 rounded-bl-3xl'></td>
                            <td>Cena celkem: <span class='font-bold'>$tplData[cenaCelkem]</span> Kč</td>
                            <td></td>
                            <td class='rounded-br-3xl'>
                                <button type='submit' name='btnObjednat'>
                                    <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                        <path stroke-linecap='round' stroke-linejoin='round' d='M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                                    </svg>
                                </button>
                            </td>
                        </tr>";
                    }
                }
            }

            /** Objednání zboží */
            if(isset($_POST['btnObjednat'])){
                $objednavka = $this->db->vratVytvorenouNeodeslanouObjednavku();
                $id_objednavka = $objednavka['id'];
                $produktyVKosiku = $this->db->vratProduktyZKosiku($id_objednavka);
                $muzeObjednat = true;
                if(!empty($produktyVKosiku)){
                    foreach($produktyVKosiku as $produkt){
                        $ziskany = $this->db->vratProdukt($produkt['id_produkt']);
                        if($ziskany['uskladneno_ks'] == 0){
                            $muzeObjednat = false;
                            $tplData['jeObjednano'] = false;
                            $this->db->odeberProduktZKosiku($id_objednavka,$produkt['id_produkt']);
                        }
                    }
                }else{
                    $muzeObjednat = false;
                }

                if($muzeObjednat){
                    $staleMuze = true;
                    foreach ($produktyVKosiku as $produkt){
                        $ziskanyPr = $this->db->vratProdukt($produkt['id_produkt']);
                        $ziskanyPr['uskladneno_ks'] -= $produkt['pocet_ks'];
                        if($ziskanyPr['uskladneno_ks'] < 0){
                            $staleMuze = false;
                            $tplData['jeObjednano']  = false;
                        }
                    }

                    if($staleMuze){
                        foreach($produktyVKosiku as $produkt){
                            $tplData['jeObjednano'] = $this->db->objednejZbozi($id_objednavka);
                            $ziskanyPr = $this->db->vratProdukt($produkt['id_produkt']);
                            $ziskanyPr['uskladneno_ks'] -= $produkt['pocet_ks'];
                            $this->db->upravMnozstviUskladnenychProduktu($ziskanyPr['id'],$ziskanyPr['uskladneno_ks']);
                        }
                    }
                }else{
                    $tplData['jeObjednano'] = false;
                }
            }

            /** Výpis všech dostupných produktů */
            $p = $this->db->vratProdukty();
            $prazdnyKosik = true;
            foreach($p as $produkt) {
                if ($produkt['uskladneno_ks'] > 0) {
                    $prazdnyKosik = false;
                    $tplData['vsechnyProdukty'] .=
                        "<div class='m-3 grid bg-emerald-400 justify-center drop-shadow-lg'>
                                <div>
                                    <img class='w-auto' src='resources/".$produkt['foto']."' alt='".$produkt['nazev']."'>
                                    <div class='grid justify-center items-center font-mono'>".$produkt['nazev']."</div>
                                </div>
                                <div class='grid'>
                                    <div class='m-5 text-balance font-thin'>".$produkt['popis']."</div>
                                    <div class='flex justify-end mb-5 mr-10 items-center'>".$produkt['cena']." Kč</div>
                                    <form class='flex justify-center items-center mb-2' method='post'>
                                        <button class='flex border-solid border-2 rounded-2xl p-2 border-emerald-200 bg-emerald-200 hover:bg-emerald-300 hover:text-white transition duration-200' id='btnDoKosiku$produkt[id]' name='btnDoKosiku$produkt[id]'><svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='w-6 h-6'>
                                            <path stroke-linecap='round' stroke-linejoin='round' d='M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z' />
                                        </svg>Přidat do košíku</button>
                                        <input type='hidden' name='id_produkt' value='$produkt[id]'>
                                        <input type='hidden' name='nazev' value='$produkt[nazev]'>
                                        <input type='hidden' name='uskladneno_ks' value='$produkt[uskladneno_ks]'>
                                        <input type='hidden' name='foto' value='$produkt[foto]'>
                                    </form>
                                </div>
                         </div>";
                }
            }
            if($prazdnyKosik){
                $tplData['hlavickaVsechProduktu'] = "<div class='grid'>";
                $tplData['vsechnyProdukty'] .=
                    "<div class='flex justify-center items-center font-roboto font-bold text-balance m-10'>
                        <p class='text-xl'>Momentálně se v nabídce nenacházejí žádné produkty.</p>   
                     </div>";
            }

        }

        $tplData['prod'] = $this->db->vratProdukty();
        return $tplData;
    }
}