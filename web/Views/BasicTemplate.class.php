<?php

namespace application\Views;

/**
 * Šablona pro všechny použité stránky
 * @author Robert Onder
 */
class BasicTemplate implements IView{
    const PAGE_UVOD = "HomePageTemplate.tpl.php";
    const PAGE_NABIDKA = "NabidkaTemplate.tpl.php";
    const PAGE_PRIHLASENI = "LoginTemplate.tpl.php";
    const PAGE_REGISTRACE = "RegistrationTemplate.tpl.php";
    const PAGE_DODAVATEL = "SupplierTemplate.tpl.php";
    const PAGE_ADMIN = "AdminTemplate.tpl.php";

    public function printOutput(array $templateData, string $pageType = self::PAGE_UVOD): void{
        global $tplData;
        $tplData = $templateData;
        $this->getHeader($templateData['title'],$tplData);
        require_once($pageType);
        $this->getFooter();
    }

    /**
     * Tvorba hlavičky
     * @param string $pageTitle
     * @param $tplData
     * @return void
     */
    public function getHeader(string $pageTitle,$tplData):void{   ?>
        <!doctype html>
        <html lang="cs">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta http-equiv="X-UA-Compatible" content="IE=edgE">

                <title>
                    <?php
                        if($tplData['jePrihlasen'] && $pageTitle == "Přihlášení"){
                            echo "Profil";
                        }else{
                            echo $pageTitle;
                        }
                    ?>
                </title>
                
                <link rel="shortcut icon" href="resources/burger-tab-icon.ico">
                <link rel="stylesheet" href="web/Views/styling/output.css">
                <script>
                    function showUser(idpravoprihlaseny,str) {
                        if (str === "") {
                            document.getElementById("txtHint").innerHTML = "";
                        } else {
                            const xmlhttp = new XMLHttpRequest();
                            xmlhttp.onreadystatechange = function() {
                                if (this.readyState === 4 && this.status === 200) {
                                    document.getElementById("txtHint").innerHTML = this.responseText;
                                }
                            };
                            xmlhttp.open("GET","web/Ajax/ziskejUzivateleAJAX.php?idpp="+idpravoprihlaseny+"&q="+str,true);
                            xmlhttp.send();
                        }
                    }
                    function zmenPravo(id,idpravo,idpp){
                        const xmlhttp = new XMLHttpRequest();
                        xmlhttp.onreadystatechange = function() {
                            if (this.readyState === 4 && this.status === 200) {
                                showUser(idpp,id);
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Uživatelské právo změněno',
                                })
                            }
                        };
                        xmlhttp.open("GET","web/Ajax/upravUzivateleAJAX.php?q="+id+"&s="+idpravo+"&idpp="+idpp,true);
                        xmlhttp.send();
                    }
                </script>
            </head>
            <body class="bg-emerald-500">
                <div class="md:grid md:grid-cols-3 md:h-screen">
                    <div class="fixed md:relative w-full md:w-auto z-50 top-0 lg:col-span-1 md:pt-20 bg-emerald-100">
                        <div class="grid grid-cols-3">
                            <div class="flex items-center md:justify-center pl-3 md:pl-0 col-span-2 md:col-span-3">
                                <h1 class="text-zinc-600 font-bold font-montserrat text-xl lg:text-2xl uppercase">Burger EXPRESS</h1>
                                <div><img class="w-10" src="web/Views/styling/img/hamburger.svg" alt="burger-logo"></div>
                            </div>
                            <div class="md:hidden flex justify-end items-center pr-10 col-span-1">
                                <svg id="burger" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                                </svg>
                            </div>
                        </div>
                        <div>
                            <nav class="hidden md:block mt-5" id="menu">
                                <!-- Navbar links -->
                                    <div class="text-gray-500 text-md lg:text-lg font-roboto pb-3">
                                        <?php if($tplData['jePrihlasen'] && $tplData['role'] != 2 && $tplData['role'] != 3){ ?>
                                            <a href="index.php?page=nabidka">
                                                <div id="liNabidka" class="flex justify-center items-center">
                                                    Nabídka
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-3 w-7 h-7">
                                                        <path id="pathNabidka" stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <?php
                                        if(!$tplData['jePrihlasen']){
                                        ?>
                                            <a href="index.php?page=profil">
                                                <div id="liPrihlaseni" class="flex justify-center items-center">
                                                    <?=$tplData['prihlasenTitle']?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-3 w-7 h-7">
                                                        <path id="pathPrihlaseni" stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>
                                                </div>
                                            </a>
                                            <?php
                                        }if($tplData['jePrihlasen']){
                                        ?>
                                            <a href="index.php?page=profil">
                                                <div id="liPrihlaseni" class="flex justify-center items-center">
                                                    <?=$tplData['prihlasenTitle']?>
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-3 w-7 h-7">
                                                        <path id="pathPrihlaseni" stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php } if(!$tplData['jePrihlasen']){ ?>
                                            <a href="index.php?page=registrace">
                                                <div id="liRegistrace" class="flex justify-center items-center">
                                                    Registrace
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-3 w-7 h-7">
                                                        <path id="pathRegistrace" stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <?php if($tplData['jePrihlasen'] && $tplData['role'] % 2 == 1){ ?>
                                            <a href="index.php?page=dodavatel">
                                                <div id="liDodavatel" class="flex justify-center items-center">
                                                    Dodavatelská sekce
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-3 w-7 h-7">
                                                        <path id="pathDodavatel" stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75 2.25 12l4.179 2.25m0-4.5 5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0 4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0-5.571 3-5.571-3" />
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php } ?>
                                        <?php if($tplData['jePrihlasen'] && $tplData['role'] < 3){ ?>
                                            <a href="index.php?page=admin">
                                                <div id="liAdmin" class="flex justify-center items-center">
                                                    Administrátorská sekce
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="m-3 w-7 h-7">
                                                        <path id="pathAdmin" stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                                    </svg>
                                                </div>
                                            </a>
                                        <?php } ?>
                                    </div>
                            </nav>
                        </div>
                    </div>
                <div id="telo" class="bg-emerald-500 md:col-span-2 pt-10 md:pt-0">
        <?php
    }

    /**
     * Tvorba patičky
     * @return void
     */
    public function getFooter(){
        ?>
        <?php /** Zde končí tělo všech stránek */ ?>
                </div>
                    </div>
        <?php /** Zde začíná tělo všech stránek */ ?>
<!--        <footer>-->
<!--            <div>-->
<!--                <span><b>Burger Express @2023</b></span>-->
<!--            </div>-->
<!--        </footer>-->
        <script>const msg = 'Opravdu chcete odebrat tento produkt z nabídky?';</script>
        <script>const msgUplneOdstraneni = 'Opravdu chcete nadobro smazat tento produkt?';</script>
        <script src="libraries/jquery/dist/jquery.min.js"></script>
        <script src="web/Views/styling/script.js"></script>
            </body>
        </html>
    <?php
    }
}
?>






