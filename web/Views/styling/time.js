updateTime();

async function updateTime() {
    const now = new Date();
    let dayInWeek = now.getDay();
    let day = now.getDate();
    let month = now.getMonth() + 1;
    let year = now.getFullYear();
    let hours = now.getHours();
    let minutes = now.getMinutes();
    let seconds = now.getSeconds();

    let dayInWeekName =
        (dayInWeek === 1) ? "pondělí" :
            (dayInWeek === 2) ? "úterý" :
                (dayInWeek === 3) ? "středa" :
                    (dayInWeek === 4) ? "čtvrtek" :
                        (dayInWeek === 5) ? "pátek" :
                            (dayInWeek === 6) ? "sobota" :
                                (dayInWeek === 7) ? "neděle" : "";

    // Přidání nuly před číslice menší než 10 pro lepší formát
    hours = (hours < 10) ? "0" + hours : hours;
    minutes = (minutes < 10) ? "0" + minutes : minutes;
    seconds = (seconds < 10) ? "0" + seconds : seconds;

    // Zobrazení času na stránce
    document.getElementById('time').innerHTML = dayInWeekName + " " + day + "." + month + "." + year + " " + hours + ":" + minutes + ":" + seconds;

    // Počkej 1 sekundu a poté zavolej funkci updateTime znovu
    await new Promise(resolve => setTimeout(resolve, 1000));
    updateTime();
}
