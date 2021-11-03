function validacio() {
    let nev = document.getElementById('nev');
    let szuletesi_nap = document.getElementById('szuletesi_nap');
    let nem = document.getElementById('nem');
    let suly = document.getElementById('suly');
    let kinezet = document.getElementById('kinezet');

    let logikai = true;

    if (nev.value === "") {
        document.getElementById('hibaNev').innerHTML = "Addja meg a cica nevét!";
        logikai = false;
    } else if (nev.value !== "") {
        document.getElementById('hibaNev').innerHTML = "";
    }

    if (szuletesi_nap.value === "") {
        document.getElementById('hibaSzuletesi_nap').innerHTML = "A cicának a születési dátuma fontos,<br>ha nem tudod pontosan akkor elég egy körülbelüli időpont is!";
        logikai = false;
    } else if (szuletesi_nap.value !== "") {
        document.getElementById('hibaSzuletesi_nap').innerHTML = "";
    }

    if (nem.value === "") {
        document.getElementById('hibaNem').innerHTML = "A cicája nemét kérem adja meg! <br>(Ajánlatos a hátsó lábai közé nézni)";
        logikai = false;
    } else if (nem.value !== "") {
        document.getElementById('hibaNem').innerHTML = "";
    }

    if (suly.value.length == 0) {
        document.getElementById('hibaSuly').innerHTML = "A cica súlyát el felejtette megadni,<br>nem kell pontos adat!";
        logikai = false;
    } else if (isNaN(suly.value)) {
        document.getElementById('hibaSuly').innerHTML = "A cica súlya szám formátumban kéretett!";
        logikai = false;
    } else if (suly.value.length != 0) {
        document.getElementById('hibaSuly').innerHTML = "";
    } else if (!isNaN(suly.value)) {
        document.getElementById('hibaSuly').innerHTML = "";
    }

    if (kinezet.value === "") {
        document.getElementById('hibaKinezet').innerHTML = "A cica kinézetét kérem adjam meg!";
        logikai = false;
    } else if (kinezet.value !== "") {
        document.getElementById('hibaKinezet').innerHTML = "";
    }

    return logikai;
}

function index() {
    document.getElementById('ujCica').addEventListener('click', validacio);
}
document.addEventListener('DOMContentLoaded', index);
