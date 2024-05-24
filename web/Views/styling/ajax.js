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
            addCustomHtmlAlert();
            setTimeout(function (){
                removeCustomHtmlAlert();
            },2000);
        }
    };
    xmlhttp.open("GET","web/Ajax/upravUzivateleAJAX.php?q="+id+"&s="+idpravo+"&idpp="+idpp,true);
    xmlhttp.send();
}
function addCustomHtmlAlert() {
    const htmlAlert = document.createElement("div");
    htmlAlert.id = "customHtmlAlert"; // Důležité pro pozdější odstranění
    htmlAlert.innerHTML = `<div id="alert_success" class="fixed justify-center right-10 bottom-10 z-50 opacity-100 bg-green-200 border-t-4 border-teal-500 rounded-b font-roboto text-teal-900 px-4 py-3 shadow-md" role="alert">
                                <div class="flex justify-center items-center">
                                    <div class="py-1"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                    </div>
                                    <div class="pl-3">
                                        <p class="font-bold">Upraveno</p>
                                        <p class="text-sm">Uživatelské právo bylo upraveno.</p>
                                    </div>
                                </div>
                           </div>`;
    document.body.appendChild(htmlAlert);
}
function removeCustomHtmlAlert() {
    let alertElement = document.getElementById("customHtmlAlert");
    if (alertElement) {
        setTimeout(function () {
            alertElement = document.getElementById("customHtmlAlert");
            alertElement.classList.remove('opacity-100');
            alertElement.classList.add('opacity-0', 'transition', 'duration-1000');
            setTimeout(function () {
                alertElement = document.getElementById("customHtmlAlert");
                alertElement.remove();
            }, 1000);
        }, 1000);
    }
}