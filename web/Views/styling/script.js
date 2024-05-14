const burger = document.querySelector("#burger");
const menu = document.querySelector("#menu");
burger.addEventListener('click',()=>{
    if(menu.classList.contains('hidden')){
        menu.classList.remove('hidden');
    }else{
        menu.classList.add('hidden');
    }
})

const liDomu = document.querySelector("#liDomu");
const liNabidka = document.querySelector("#liNabidka");
const liPrihlaseni = document.querySelector("#liPrihlaseni");
const liRegistrace = document.querySelector("#liRegistrace");
const liDodavatel = document.querySelector("#liDodavatel");
const liAdmin = document.querySelector("#liAdmin");

const pathDomu = document.querySelector("#pathDomu");
const pathNabidka = document.querySelector("#pathNabidka");
const pathPrihlaseni = document.querySelector("#pathPrihlaseni");
const pathRegistrace = document.querySelector("#pathRegistrace");
const pathDodavatel = document.querySelector("#pathDodavatel");
const pathAdmin = document.querySelector("#pathAdmin");

if(liDomu != null){
    liDomu.addEventListener('mouseover', function() {
        add(liDomu, pathDomu);
    });
    liDomu.addEventListener('mouseout', function() {
        remove(liDomu, pathDomu);
    });
}

if(liNabidka != null){
    liNabidka.addEventListener('mouseover', function() {
        add(liNabidka, pathNabidka);
    });
    liNabidka.addEventListener('mouseout', function() {
        remove(liNabidka, pathNabidka);
    });
}

if(liPrihlaseni != null){
    liPrihlaseni.addEventListener('mouseover', function() {
        add(liPrihlaseni, pathPrihlaseni);
    });
    liPrihlaseni.addEventListener('mouseout', function() {
        remove(liPrihlaseni, pathPrihlaseni);
    });
}


if(liRegistrace != null){
    liRegistrace.addEventListener('mouseover', function() {
        add(liRegistrace, pathRegistrace);
    });
    liRegistrace.addEventListener('mouseout', function() {
        remove(liRegistrace, pathRegistrace);
    });
}

if(liDodavatel != null){
    liDodavatel.addEventListener('mouseover', function() {
        add(liDodavatel, pathDodavatel);
    });
    liDodavatel.addEventListener('mouseout', function() {
        remove(liDodavatel, pathDodavatel);
    });
}

if(liAdmin != null){
    liAdmin.addEventListener('mouseover', function() {
        add(liAdmin, pathAdmin);
    });
    liAdmin.addEventListener('mouseout', function() {
        remove(liAdmin, pathAdmin);
    });
}

function add(list, path) {
    list.classList.add('transition');
    list.classList.add('duration-200');
    list.classList.add('bg-emerald-500');
    list.classList.add('text-white');

    path.classList.add('transition');
    path.classList.add('duration-500');
    path.classList.add('text-emerald-300');
}

function remove(list, path) {
    list.classList.remove('transition');
    list.classList.add('duration-200');
    list.classList.remove('bg-emerald-500');
    list.classList.remove('text-white');

    path.classList.remove('transition');
    path.classList.add('duration-500');
    path.classList.remove('text-emerald-300');
}

const alerts = [
    {element: document.getElementById('alert_success'), timeout: 3000},
    {element: document.getElementById('alert_info'), timeout: 5000},
    {element: document.getElementById('alert_error'), timeout: 7000}
];

alerts.forEach(alert => {
    if(alert.element != null){
        setTimeout(function () {
            alert.element.classList.remove('opacity-100');
            alert.element.classList.add('opacity-0', 'transition', 'duration-1000');
            setTimeout(function () {
                alert.element.classList.add('hidden');
            }, 1000);
        }, alert.timeout);
    }
});

