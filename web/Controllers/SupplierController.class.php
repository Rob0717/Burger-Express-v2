<?php

namespace application\Controllers;
use application\Models\MyDatabaseModel;

/**
 * Kontroler pro dodavatelskou sekci
 * @author Robert Onder
 */
class SupplierController implements IController{

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
        if($tplData['jePrihlasen']) {
            /** Získání práva, pokud je uživatel přihlášen */
            $tplData['role'] = $this->db->ziskejDataUzivatele()['id_pravo'];
        }
        /** Deklarace proměnných daného kontroleru pro danou šablonu */
        $tplData['produkty'] = "";
        $tplData['existuje'] = false;
        $tplData['fotoUpraveno'] = false;

        /** Přidání nového produktu */
        if(isset($_POST['vlozNovy'])){
            if(isset($_POST['nazevNovy']) && isset($_POST['popisNovy']) &&
                isset($_POST['cenaNovy']) && isset($_POST['ksNovy']) &&
                trim($_POST['nazevNovy']) != "" && trim($_POST['popisNovy']) != "" &&
                isset($_FILES["souborNovy"]["name"])){

                $adr = "resources";
                // Není souborem
                if(is_file($adr)){
                    echo "Nelze vytvořit adresář resources.<br>";
                }
                // Není souborem a neexistuje?
                elseif(!file_exists($adr)) {
                    mkdir($adr);
                }
                // Nemám adresář resources?
                if(!is_dir($adr)){
                    echo "Adresář resources nelze použít.<br>";
                }

                /** Pokud typem souboru je foto a zároveň již neexistuje
                 *  foto se stejným názvem, přidám daný produkt
                 */
                $type = $_FILES["souborNovy"]["type"];
                $extensions = array("image/jpg","image/jpeg","image/png","image/gif");
                if(in_array($type, $extensions)){
                    $nazevFoto = basename( $_FILES["souborNovy"]["name"]);
                    $celyNazev = $adr."/".$nazevFoto;
                    $celyNazev = iconv("UTF-8", "WINDOWS-1250", $celyNazev);

                    $jizExistuje = $this->db->kontrolaExistenceProduktu($_FILES['souborNovy']['name']);
                    $tplData['existuje'] = true;
                    $this->db->vlozNovyProdukt($_POST['nazevNovy'],$_POST['cenaNovy'],$_POST['ksNovy'],$nazevFoto,$_POST['popisNovy']);
                    if(!$jizExistuje) {
                        move_uploaded_file($_FILES["souborNovy"]["tmp_name"], $celyNazev);
                    }
                }
            }
        }

        /** Úprava produktů v dodavatelské sekci */
        $tplData['vsechnyProdukty'] = $this->db->vratProdukty();
        foreach($tplData['vsechnyProdukty'] as $p){
            $idProduktu = $p['id'];
            if(isset($_POST["btnUpravProdukt$idProduktu"])){
                if(isset($_POST["novyNazev$idProduktu"]) && isset($_POST["novaCena$idProduktu"]) &&
                    isset($_POST["KonecnyPocet$idProduktu"]) && isset($_POST["novyPopis$idProduktu"])){
                        if(empty($_POST["novyNazev$idProduktu"])){
                            echo "ne";
                        }else{
                            $this->db->upravProdukt($idProduktu,$_POST["novyNazev$idProduktu"],$_POST["novaCena$idProduktu"],
                                $_POST["KonecnyPocet$idProduktu"],$p['foto'],$_POST["novyPopis$idProduktu"]);
                        }

                    }
                $tplData['staryPocet'] = $_POST['puvodni_pocet'];
                $pr = $this->db->vratProdukt($idProduktu);
                $tplData['novyPocet'] = $pr['uskladneno_ks'];
            }
            if(isset($_POST["btnOdstran$idProduktu"])){
                $this->db->odeberProduktZNabidky($idProduktu);
            }
            if(isset($_POST["ulozFoto$idProduktu"]) && isset($_FILES["noveFoto$idProduktu"]["name"])){
                $adr = "resources";
                if(is_file($adr)){
                    echo "Nelze vytvořit adresář resources.<br>";
                }
                elseif(!file_exists($adr)) {
                    mkdir($adr);
                }
                if(!is_dir($adr)){
                    echo "Adresář resources nelze použít.<br>";
                }
                $type = $_FILES["noveFoto$idProduktu"]["type"];
                $extensions = array("image/jpg","image/jpeg","image/png","image/gif");
                if(in_array($type, $extensions)){
                    $nazev = basename($_FILES["noveFoto$idProduktu"]["name"]);
                    $celyNazev = $adr."/".$nazev;
                    $celyNazev = iconv("UTF-8", "WINDOWS-1250", $celyNazev);
                    $this->db->upravFotoProdukt($idProduktu,$_FILES["noveFoto$idProduktu"]["name"]);
                    move_uploaded_file($_FILES["noveFoto$idProduktu"]["tmp_name"],$celyNazev);
                    $tplData['fotoUpraveno'] = true;
                }
            }
            if(isset($_POST["btnUplneOdstraneni$idProduktu"])){
                $this->db->smazProdukt($idProduktu);
            }
        }

        /** Výpis produktů v dodavatelské sekci */
        $produkty = $this->db->vratNesmazaneProdukty();
        $tplData['produkty'] .= "<div class='grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3'>";
        foreach($produkty as $produkt){
            $tplData['produkty'] .= "<div class='m-3 grid justify-center bg-emerald-200 font-roboto drop-shadow-lg'>
                                        <img class='w-auto' src='resources/".$produkt['foto']."' alt='".$produkt['nazev']."'>
                                        <form class='grid p-1 space-y-1' method='POST' enctype='multipart/form-data'>
                                            <input class='bg-emerald-300 text-white' name='noveFoto$produkt[id]' type='file' accept='image/jpg,image/jpeg,image/png,image/gif'>
                                            <input class='bg-emerald-400 hover:bg-emerald-300 text-white' type='submit' name='ulozFoto$produkt[id]' value='Uložit foto'>
                                        </form>
                                        
                                        <form method='POST' class='grid space-y-5 p-1'>
                                            <div class='grid'>
                                                <label>Název:</label>
                                                <input class='bg-emerald-100 text-center' type='text' name='novyNazev$produkt[id]' value='$produkt[nazev]' required>
                                            </div>
                                            <div class='grid'>
                                                <label>Cena:</label>
                                                <input class='bg-emerald-100 w-full text-center' type='number' name='novaCena$produkt[id]' min='20' max='1000' value='$produkt[cena]' required>
                                            </div>
                                            <div class='grid'>
                                                <label>Popis:</label>
                                                <textarea class='bg-emerald-100' name='novyPopis$produkt[id]'>$produkt[popis]</textarea>
                                            </div>
                                            <div>
                                                <label>Uskladněno:</label>
                                                <input class='bg-emerald-100 w-full text-center' id='KonecnyPocet$produkt[id]' name='KonecnyPocet$produkt[id]' type='number' min='1' max='1000' value='$produkt[uskladneno_ks]'>
                                            </div>
                                            <div class='flex justify-center'>
                                                <button class='bg-emerald-400 w-full hover:bg-emerald-300 text-white' id='btnUpravProdukt$produkt[id]' name='btnUpravProdukt$produkt[id]'>Upravit</button>
                                                <button class='bg-red-500 w-full hover:bg-red-400 text-white' onclick='return confirm(msg)' id='btnOdstran$produkt[id]' name='btnOdstran$produkt[id]'>Odebrat</button>
                                            </div>
                                                        
                                            <input type='hidden' name='puvodni_pocet' value='$produkt[uskladneno_ks]'>
                                            <input type='hidden' name='id_produkt' value='$produkt[id]'>
                                            <input type='hidden' name='nazev' value='$produkt[nazev]'>
                                            <input type='hidden' name='popis' value='$produkt[popis]'>
                                            <input type='hidden' name='uskladneno_ks' value='$produkt[uskladneno_ks]'>
                                            <input type='hidden' name='foto' value='$produkt[foto]'>
                                        </form>
                                        <form method='post' class='m-1 font-roboto drop-shadow-lg'>
                                            <div class='flex justify-center'>
                                                <input class='bg-red-500 w-full pt-2 pb-2 hover:bg-red-400 text-white' onclick='return confirm(msgUplneOdstraneni)' name='btnUplneOdstraneni$produkt[id]' type='submit' value='ODSTRANIT'>
                                            </div>
                                        </form>    
                                     </div>";
        }
        $tplData['produkty'] .= "</div>";
        return $tplData;
    }
}

